<?php
/**
 * API class for Ext. Product Display
 *
 * @author   MoMo Themes
 * @version  1.0.0
 * @package  momowcext
 */
class Momo_WC_Ext_API {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'momo_wcext_custom_rest_api' ) );
	}

	/**
	 * Setup Custom REST API Endpoints
	 */
	public function momo_wcext_custom_rest_api() {
		global $momowcext;
		$api_namespace = $momowcext->slug;
		register_rest_route(
			$api_namespace,
			'/products',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'momo_wcext_json_products_data' ),
				'permission_callback' => function ( WP_REST_Request $request ) {
					return true;
				},
			)
		);

		register_rest_route(
			$api_namespace,
			'/product',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'momo_wcext_json_single_product_data' ),
				'permission_callback' => function ( WP_REST_Request $request ) {
					return true;
				},
			)
		);

		register_rest_route(
			$api_namespace,
			'/category',
			array(
				'methods'             => 'GET',
				'callback'            => array( $this, 'momo_wcext_json_category_data' ),
				'permission_callback' => function ( WP_REST_Request $request ) {
					return true;
				},
			)
		);
	}

	/**
	 * Response from the Request API /products
	 *
	 * @param array $request Request paramenters.
	 */
	public function momo_wcext_json_products_data( $request ) {
		global $momowcext;
		$parameters = $request->get_query_params();
		$products   = $this->momo_wcext_generate_products( $parameters );
		$response   = array(
			'products' => $products,
			'styles'   => $momowcext->styles->momo_wcext_generate_styles(),
		);
		return $response;
	}
	/**
	 * Response from the Request API /events
	 *
	 * @param array $request Request paramenters.
	 */
	public function momo_wcext_json_single_product_data( $request ) {
		global $momowcext;
		$parameters = $request->get_query_params();
		$product    = $this->momo_wcext_generate_single_product( $parameters );
		$response   = array(
			'products' => $product,
			'styles'   => $momowcext->styles->momo_wcext_generate_single_styles(),
		);
		return $response;
	}
	/**
	 * Response from the Request API /events
	 *
	 * @param array $request Request paramenters.
	 */
	public function momo_wcext_json_category_data( $request ) {
		global $momowcext;
		$parameters = $request->get_query_params();
		$products   = $this->momo_wcext_generate_products_by_category( $parameters );

		$response = array(
			'products' => $products,
			'styles'   => $momowcext->styles->momo_wcext_generate_styles(),
		);
		return $response;
	}
	/**
	 * Generate Products by Category
	 *
	 * @param array $args Request parameters.
	 */
	public function momo_wcext_generate_products_by_category( $args = '' ) {
		global $momowcext;
		ob_start();
		$no_of_prod = isset( $args['nop'] ) ? (int) $args['nop'] : 5;
		$new_window = isset( $args['new_window'] ) ? $args['new_window'] : true;
		$args       = array(
			'limit'       => $no_of_prod,
			'columns'     => '3',
			'type'        => 'category',
			'category_id' => isset( $args['category_id'] ) ? $args['category_id'] : null,
		);
		$content    = $momowcext->wc->momo_wcext_generate_product_content( $args );

		return $content;
	}
	/**
	 * Generate Single Product
	 *
	 * @param array $args Request parameters.
	 */
	public function momo_wcext_generate_single_product( $args = '' ) {
		global $momowcext;
		$woo_product_id = isset( $args['product_id'] ) ? $args['product_id'] : '';
		if ( empty( $woo_product_id ) ) {
			return;
		}
		$atts['ids']     = $woo_product_id;
		$atts['limit']   = '1';
		$atts['column']  = '1';
		$atts['type']    = 'single';
		$atts['columns'] = '1';

		$content = $momowcext->wc->momo_wcext_generate_product_content( $atts );

		return $content;
	}

	/**
	 * Generate Events
	 *
	 * @param array $args Request parameters.
	 */
	public function momo_wcext_generate_products( $args = '' ) {
		global $momowcext;
		ob_start();
		$no_of_prod = isset( $args['nop'] ) ? (int) $args['nop'] : 5;
		$new_window = isset( $args['new_window'] ) ? $args['new_window'] : true;
		$args       = array(
			'limit'   => $no_of_prod,
			'columns' => '3',
			'type'    => 'multiple',
			'ids'     => isset( $args['ids'] ) ? $args['ids'] : array(),
		);

		$content = $momowcext->wc->momo_wcext_generate_product_content( $args );

		return $content;
	}
	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	public function momo_wcext_woocommerce_template_loop_product_title() {
		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	/**
	 * Get the product thumbnail for the loop.
	 */
	public function momo_wc_ext_woocommerce_template_loop_product_thumbnail() {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo woocommerce_get_product_thumbnail();
	}
	/**
	 * Return Element Header
	 *
	 * @param string $el_name Element name.
	 * @param string $class_name Element class name.
	 * @param string $link Link.
	 * @param string $target Target data.
	 */
	public function momo_wcext_element_open( $el_name, $class_name = '', $link = '', $target = '' ) {
		if ( 'a' === $el_name ) {
			$output = '<' . $el_name . ' class="' . $class_name . '" href="' . $link . '" target="' . $target . '">';
		} else {
			$output = '<' . $el_name . ' class="' . $class_name . '">';
		}
		return $output;
	}

	/**
	 * Return Element Closure
	 *
	 * @param string $el_name Element name.
	 */
	public function momo_wcext_element_close( $el_name ) {
		$output = '</' . $el_name . '>';
		return $output;
	}
}
