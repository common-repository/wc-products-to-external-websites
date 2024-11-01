<?php
/**
 * WooCommerce Products Generation
 *
 * @author   MoMo Themes
 * @version  1.0.0
 * @package  momowcext
 */
class Momo_WC_Ext_Products {
	/**
	 * Generate Product Contents
	 *
	 * @param array $args Arguments.
	 */
	public function momo_wcext_generate_product_content( $args ) {
		global $momowcext;
		$query_args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => false,
			'orderby'             => 'menu_order title',
			'order'               => 'ASC',
			'fields'              => 'ids',
		);

		$type    = $args['type'];
		$limit   = $args['limit'];
		$columns = $args['columns'];

		$query_args['tax_query'] = WC()->query->get_tax_query(); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		if ( 'multiple' === $type ) {
			$query_args['posts_per_page'] = $limit;
			$query_args['no_found_rows']  = true;
		} elseif ( 'single' === $type ) {
			$query_args['posts_per_page'] = 1;
			$query_args['p']              = $args['ids'];
		} elseif ( 'category' === $type ) {
			$category_id = $args['category_id'];

			$query_args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				'relation' => 'AND',
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'id',
					'terms'    => array( $category_id ),
				),
			);
		}

		$query = new WP_Query( $query_args );

		$paginated = ! $query->get( 'no_found_rows' );

		$products = (object) array(
			'ids'          => wp_parse_id_list( $query->posts ),
			'total'        => $paginated ? (int) $query->found_posts : count( $query->posts ),
			'total_pages'  => $paginated ? (int) $query->max_num_pages : 1,
			'per_page'     => (int) $query->get( 'posts_per_page' ),
			'current_page' => $paginated ? (int) max( 1, $query->get( 'paged', 1 ) ) : 1,
		);
		ob_start();
		if ( 'category' === $type ) {
			$type = 'multiple';
		}
		$this->momo_wcext_generate_header_footer( 'header', $type, $columns );
		if ( $products && $products->ids ) {
			$results = $products;
			$setup   = array(
				'columns'      => $columns,
				'type'         => $type,
				'total'        => $products->total,
				'total_pages'  => $products->total_pages,
				'per_page'     => $products->per_page,
				'current_page' => $products->current_page,
			);
			foreach ( $products->ids as $product_id ) {
				$GLOBALS['post'] = get_post( $product_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata( $GLOBALS['post'] );
				$t = $momowcext->fn->momo_get_template_part( 'content', 'momo-' . $type . '-product' );
			}
			wp_reset_postdata();
		} else {
			do_action( 'woocommerce_shortcode_product_loop_no_results', $products );
		}
		$this->momo_wcext_generate_header_footer( 'footer' );
		return ob_get_clean();
	}
	/**
	 * Generate header footer content.
	 *
	 * @param string $purpose Header or footer.
	 * @param array  $type Single or Multiple.
	 * @param int    $columns No of Columns.
	 */
	public function momo_wcext_generate_header_footer( $purpose = 'header', $type = '', $columns = '' ) {
		$class  = 'momo-multiple-products';
		$cclass = 'columns-' . $columns;
		if ( 'single' === $type ) {
			$class = 'momo-single-product';
		}
		if ( 'header' === $purpose ) {
			echo '<div class="woocommerce ' . esc_attr( $cclass ) . ' "><ul class="products ' . esc_attr( $cclass ) . '">';
		} else {
			echo '</ul></div>';
		}
	}
}
