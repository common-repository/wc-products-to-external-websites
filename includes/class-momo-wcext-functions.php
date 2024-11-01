<?php
/**
 * Shopify Imports functions
 *
 * @package momowcext
 * @author MoMo Themes
 * @since v1.0.0
 */
class MoMo_WC_Ext_Functions {
	/**
	 * Returns check option check or unchecked
	 *
	 * @param array  $settings Settings array.
	 * @param string $key Option key.
	 */
	public function momo_be_return_check_option( $settings, $key ) {
		$option = isset( $settings[ $key ] ) ? $settings[ $key ] : 'off';
		if ( 'on' === $option ) {
			$check = 'checked="checked"';
		} else {
			$check = '';
		}
		return $check;
	}
	/**
	 * Returns text option
	 *
	 * @param array  $settings Settings array.
	 * @param string $key Option key.
	 */
	public function momo_be_return_text_option( $settings, $key ) {
		$option = isset( $settings[ $key ] ) ? $settings[ $key ] : '';
		return $option;
	}
	/**
	 * Returns check option check or unchecked
	 *
	 * @param array  $settings Settings array.
	 * @param string $key Option key.
	 */
	public function momo_be_return_option_yesno( $settings, $key ) {
		$option = isset( $settings[ $key ] ) ? $settings[ $key ] : 'off';
		return $option;
	}
	/**
	 * Get Templates
	 *
	 * @param string $slug Slug.
	 * @param string $name Name.
	 * @param string $preurl Pre URL.
	 */
	public function momo_get_template_part( $slug, $name = '', $preurl = '' ) {
		global $momowcext;
		$template = '';

		if ( $preurl ) {
			$template = $preurl . "/{$slug}-{$name}.php";
		} else {
			// Look in yourtheme/slug-name.php and yourtheme/momowxext/slug-name.php.
			if ( $name ) {
				$child_theme_path = get_stylesheet_directory();
				$template         = locate_template(
					array(
						"{$slug}-{$name}.php",
						get_template_directory() . '/' . $momowcext->template_path . $slug . '-' . $name . '.php',
						$child_theme_path . '/' . $momowcext->template_path . $slug . '-' . $name . '.php',
						"{$momowcext->template_url}{$slug}-{$name}.php",
					)
				);
			}

			// Get default slug-name.php.
			$file_exist = file_exists( MOMO_WCEXT_PATH . "/templates/{$slug}-{$name}.php" );
			if ( ! $template && $name && $file_exist ) {
				$template = MOMO_WCEXT_PATH . "/templates/{$slug}-{$name}.php";
			}
			// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/momowcext/slug.php.
			if ( ! $template ) {
				$template = locate_template( array( "{$slug}.php", "{$momowcext->template_path}{$slug}.php" ) );
			}
		}

		if ( $template ) {
			load_template( $template, false );
		}
	}
	/**
	 * Get core source url
	 *
	 * @param string $handle Handle.
	 */
	public function momo_get_src_url( $handle ) {
		$wpscripts = wp_scripts();
		$jquery    = $wpscripts->registered[ $handle ];
		$src       = $jquery->src;
		if ( ! preg_match( '|^(https?:)?//|', $src ) && ! ( $wpscripts->content_url && 0 === strpos( $src, $wpscripts->content_url ) ) ) {
			$src = $wpscripts->base_url . $src;
		}
		return $src;
	}
}
