<?php
/**
 * MoMO WcExt - Product Script
 *
 * @author MoMo Themes
 * @package momowcext
 * @since v1.0.0
 */

global $momowcext;
$momo_wcext_settings = get_option( 'momo_wcext_settings' );
$open_new_tab        = $momowcext->fn->momo_be_return_option_yesno( $momo_wcext_settings, 'open_new_tab' );
?>
<div class="momo-admin-content-box">
	<div class="momo-be-table-header">
		<h3><?php esc_html_e( 'Product Script', 'momowcext' ); ?></h3>
	</div>
	<div class="momo-ms-admin-content-main momowcext-import-main" id="momowcext-product-script-block">
		<div class="momo-be-msg-block"></div>
		<div class="momo-be-section">
			<h2><?php esc_html_e( 'Multiple Products', 'momowcext' ); ?></h2>
			<div class="momo-be-option-block show">
				<div class="momo-be-block">
					<p>
						<label class="regular inline">
							<?php
							esc_html_e( 'Number of Product(s) ', 'momowcext' );
							?>
						</label>
						<select class="inline trigger-mp-ta-change" name="momowxext_multiple_product_count" autocomplete="off">
							<?php for ( $i = 1; $i <= 15; $i++ ) : ?>
							<option value="<?php echo esc_attr( $i ); ?>" <?php echo esc_attr( ( 5 === $i ) ? 'selected="selected"' : '' ); ?>><?php echo esc_html( $i ); ?></option>
							<?php endfor; ?>
						</select>
					</p>
				</div>
				<div class="momo-be-block">
					<label class="regular inline"><?php esc_html_e( 'Loading Text', 'momowsw' ); ?></label>
					<input type="text" class="inline trigger-mp-ta-change" name="multiple_product_loading_text" placeholder="<?php esc_attr_e( 'Products Loading....', 'momowcext' ); ?>" autocomplete="off" value="<?php esc_attr_e( 'Products Loading....', 'momowcext' ); ?>"/>
				</div>
				<div class="momo-be-block momo-mt-20">
					<label class="regular"><?php esc_html_e( 'Copy Script', 'momowsw' ); ?></label>
					<textarea name="multiple_products_script" class="momo-w-100" style='height: 250px;' autocomplete="off">
<!-- Script and HTML text preloaded inside textarea to copy -->
<?php
wp_print_script_tag(
	array(
		'src' => $momowcext->fn->momo_get_src_url( 'jquery-core' ),
	)
);
wp_print_script_tag(
	array(
		'src'  => esc_html( $momowcext->plugin_url ) . 'assets/js/momowcext.js?ver=' . esc_html( $momowcext->version ),
		'type' => 'text/javascript',
	)
);
?>
<script type='text/javascript'>
	jQuery(document).ready(function($){
		$('#momo-wc-ext-mp-content').momoWcExtDisplay({
			endpoint: '<?php echo esc_url( site_url() ); ?>/wp-json/momowcext/products',
			product_url: '<?php echo esc_url( site_url() ); ?>',
			loading_text: '<?php esc_html_e( 'Products Loading...', 'momowcext' ); ?>',
			nop: 5,
			view: 'normal',
			type: 'momo-multiple-products',
			new_window: <?php echo esc_html( ( 'on' === $open_new_tab ) ? 'true' : 'false' ); ?>,
		});
	});
</script>
<div id='momo-wc-ext-mp-content' style='height:100%; width:100%'></div>
<!-- Ends Script and HTML text preloaded inside textarea to copy -->
					</textarea>
				</div>
				<div class="momo-be-block momo-mt-20">
					<span class="momowcext-copy-clipboard">
						<i class='bx bxs-copy-alt'></i><?php esc_html_e( 'Copy', 'momowcext' ); ?>
					</span>
				</div>
			</div><!-- ends .momo-be-option-block -->
		</div><!-- Ends .momo-be-section -->
		<div class="momo-be-section">
			<h2><?php esc_html_e( 'Single Product', 'momowcext' ); ?></h2>
			<div class="momo-be-option-block show">
				<div class="momo-be-block">
					<label class="regular inline"><?php esc_html_e( 'Loading Text', 'momowsw' ); ?></label>
					<input type="text" class="inline trigger-sp-ta-change" name="single_product_loading_text" placeholder="<?php esc_attr_e( 'Product Loading....', 'momowcext' ); ?>" autocomplete="off" value="<?php esc_attr_e( 'Product Loading....', 'momowcext' ); ?>"/>
				</div>
				<div class="momo-be-block">
					<p>
						<label class="regular inline">
							<?php
							esc_html_e( 'Select WooProduct ', 'momowcext' );
							?>
						</label>
						<select class="inline trigger-sp-ta-change" name="momowxext_single_product_select" id="momowxext_single_product_select" autocomplete="off"></select>
					</p>
				</div>
				<div class="momo-be-block momo-mt-20">
					<label class="regular"><?php esc_html_e( 'Copy Script', 'momowsw' ); ?></label>
					<textarea name="single_product_script" class="momo-w-100" style='height: 250px;' autocomplete="off">
<!-- Script and HTML text preloaded inside textarea to copy -->
<?php
wp_print_script_tag(
	array(
		'src' => $momowcext->fn->momo_get_src_url( 'jquery-core' ),
	)
);
wp_print_script_tag(
	array(
		'src'  => esc_html( $momowcext->plugin_url ) . 'assets/js/momowcext.js?ver=' . esc_html( $momowcext->version ),
		'type' => 'text/javascript',
	)
);
?>
<script type='text/javascript'>
	jQuery(document).ready(function($){
		$('#momo-wc-ext-sp-content').momoWcExtDisplay({
			endpoint: '<?php echo esc_url( site_url() ); ?>/wp-json/momowcext/product',
			product_url: '<?php echo esc_url( site_url() ); ?>',
			product_id: false,
			loading_text: '<?php esc_html_e( 'Product Loading...', 'momowcext' ); ?>',
			view: 'normal',
			type: 'momo-single-product',
			new_window: <?php echo esc_html( ( 'on' === $open_new_tab ) ? 'true' : 'false' ); ?>,
		});
	});
</script>
<div id='momo-wc-ext-sp-content' style='height:100%; width:100%'></div>
<!-- Ends Script and HTML text preloaded inside textarea to copy -->
					</textarea>
				</div>
				<div class="momo-be-block momo-mt-20">
					<span class="momowcext-copy-clipboard">
						<i class='bx bxs-copy-alt'></i><?php esc_html_e( 'Copy', 'momowcext' ); ?>
					</span>
				</div>
			</div><!-- ends .momo-be-option-block -->
		</div><!-- Ends .momo-be-section -->
	</div>
</div>
