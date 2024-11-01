<?php
/**
 * Template to display Single Product
 *
 * @author   MoMo Themes
 * @version  1.0.0
 * @package  momowcext
 */

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$plink = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
?>
<li <?php wc_product_class( '', $product ); ?>>
	<a href="<?php echo esc_url( $plink ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
		<div class="momo-single-image-container">
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo woocommerce_get_product_thumbnail();
		?>
		</div>
		<div class="momo-single-right">
			<h2 class="<?php echo esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ); ?>">
				<?php echo esc_html( get_the_title() ); ?>
			</h2>
			<?php wc_get_template( 'loop/price.php' ); ?>
		</div>
		<?php wc_get_template( 'loop/sale-flash.php' ); ?>
		<?php
		woocommerce_template_single_excerpt();
		?>
	</a>
</li>
<?php
