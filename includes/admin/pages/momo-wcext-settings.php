<?php
/**
 * MoMo WC External - Admin Settings Page
 *
 * @author MoMo Themes
 * @package momowcext
 * @since v1.0
 */

global $momowcext;
$momowcext_options = get_option( 'momowcext_options' );
?>
<div id="momo-be-form">
	<div class="momo-be-wrapper">
		<h2 class="nav-tab-wrapper">  
			<div class="nav-tab nav-tab-active">
				<?php esc_html_e( 'MoMo Themes - WcExt', 'momowcext' ); ?>
			</div>
		</h2>

		<table class="momo-be-tab-table">
			<tbody>
				<tr>
					<td valign="top">
						<ul class="momo-be-main-tab">
							<li><a class="momo-be-tablinks active" href="#momo-be-settings-momo-wcext"><i class='bx bx-slider-alt'></i><span><?php esc_html_e( 'Settings', 'momowcext' ); ?></span></a></li>
							<li><a class="momo-be-tablinks" href="#momo-be-wcext-product-script"><i class='bx bx-image-alt'></i><span><?php esc_html_e( 'Product Script', 'momowcext' ); ?></span></a></li>
							<li><a class="momo-be-tablinks" href="#momo-be-wcext-category-script"><i class='bx bx-category-alt' ></i><span><?php esc_html_e( 'Category Script', 'momowcext' ); ?></span></a></li>
						</ul>
					</td>
					<td class="momo-be-main-tabcontent" width="100%" valign="top">
						<div class="momo-be-working"></div>	
						<div id="momo-be-settings-momo-wcext" class="momo-be-admin-content active">
							<form method="post" action="options.php" id="momo-momowcext-admin-settings-form">
								<?php settings_fields( 'momowcext-settings-group' ); ?>
								<?php do_settings_sections( 'momowcext-settings-group' ); ?>
								<?php require_once 'page-momo-wcext-settings.php'; ?>
								<?php submit_button(); ?>
							</form>
						</div>
						<div id="momo-be-wcext-product-script" class="momo-be-admin-content">
							<?php require_once 'page-momo-wcext-product-script.php'; ?>
						</div>
						<div id="momo-be-wcext-category-script" class="momo-be-admin-content">
							<?php require_once 'page-momo-wcext-category-script.php'; ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
