<?php
/**
 * MoMo WSW - Shopify Settings Page
 *
 * @author MoMo Themes
 * @package momowcext
 * @since v1.0.0
 */

global $momowcext;
$momo_wcext_settings = get_option( 'momo_wcext_settings' );
$enable_footer_link  = $momowcext->fn->momo_be_return_check_option( $momo_wcext_settings, 'enable_footer_link' );
$open_new_tab        = $momowcext->fn->momo_be_return_check_option( $momo_wcext_settings, 'open_new_tab' );
$link_text           = $momowcext->fn->momo_be_return_text_option( $momo_wcext_settings, 'link_text' );
$link_url            = $momowcext->fn->momo_be_return_text_option( $momo_wcext_settings, 'link_url' );
?>
<div class="momo-admin-content-box">
	<div class="momo-be-table-header">
		<h3><?php esc_html_e( 'WC External View Settings', 'momowcext' ); ?></h3>
	</div>
	<div class="momo-ms-admin-content-main" id="momo-wsw-settings-form">
		<div class="momo-be-section">
			<div class="momo-be-block momo-mb-10 momo-border-line">
				<span class="momo-be-toggle-container" momo-be-tc-yes-container="enable_footer_link">
					<label class="switch">
						<input type="checkbox" class="switch-input" name="momo_wcext_settings[enable_footer_link]" autocomplete="off" <?php echo esc_attr( $enable_footer_link ); ?>>
						<span class="switch-label" data-on="Yes" data-off="No"></span>
						<span class="switch-handle"></span>
					</label>
				</span>
				<span class="momo-be-toggle-container-label">
					<?php esc_html_e( 'Enable footer link', 'momowcext' ); ?>
				</span>
				<div class="momo-be-tc-yes-container" id="enable_footer_link">
					<div class="momo-be-block">
						<label class="regular inline"><?php esc_html_e( 'Link text', 'momowcext' ); ?></label>
						<input type="text" class="inline" name="momo_wcext_settings[link_text]" value="<?php echo esc_attr( $link_text ); ?>"/>
					</div>
					<div class="momo-be-block">
						<label class="regular inline"><?php esc_html_e( 'Link URL', 'momowcext' ); ?></label>
						<input type="text" class="inline" name="momo_wcext_settings[link_url]" value="<?php echo esc_attr( $link_url ); ?>"/>
					</div>
				</div>
			</div>
			<div class="momo-be-block">
				<span class="momo-be-toggle-container">
					<label class="switch">
						<input type="checkbox" class="switch-input" name="momo_wcext_settings[open_new_tab]" autocomplete="off" <?php echo esc_attr( $open_new_tab ); ?>>
						<span class="switch-label" data-on="Yes" data-off="No"></span>
						<span class="switch-handle"></span>
					</label>
				</span>
				<span class="momo-be-toggle-container-label">
					<?php esc_html_e( 'Open product link in new tab.', 'momowcext' ); ?>
				</span>
			</div>
		</div>
	</div>
</div>
