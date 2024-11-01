<?php
/**
 * Admin Init
 *
 * @package momowcext
 */
class MoMo_WC_Ext_Admin_Init {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'momo_wcext_set_admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'momowcext_print_admin_ss' ) );

		add_action( 'admin_init', array( $this, 'momowcext_register_settings' ) );

		$ajax_events = array(
			'momo_wcext_woo_product_list_search'  => 'momo_wcext_woo_product_list_search',
			'momo_wcext_woo_category_list_search' => 'momo_wcext_woo_category_list_search',
		);
		foreach ( $ajax_events as $ajax_event => $class ) {
			add_action( 'wp_ajax_' . $ajax_event, array( $this, $class ) );
			add_action( 'wp_ajax_nopriv_' . $ajax_event, array( $this, $class ) );
		}

	}

	/**
	 * Product List Search
	 */
	public function momo_wcext_woo_product_list_search() {
		global $momowsw;
		$res = check_ajax_referer( 'momowcext_security_key', 'security' );
		if ( isset( $_POST['action'] ) && 'momo_wcext_woo_product_list_search' !== $_POST['action'] ) {
			return;
		}
		$query          = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : '';
		$search_results = new WP_Query(
			array(
				's'                   => $query,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'post_type'           => 'product',
				'posts_per_page'      => 50,
			)
		);

		$return = array();
		if ( $search_results->have_posts() ) :
			while ( $search_results->have_posts() ) :
				$search_results->the_post();
				$title    = ( mb_strlen( $search_results->post->post_title ) > 50 ) ? mb_substr( $search_results->post->post_title, 0, 49 ) . '...' : $search_results->post->post_title;
				$return[] = array( $search_results->post->ID, $title );
			endwhile;
		endif;
		echo wp_json_encode( $return );
		die;
	}
	/**
	 * Category List Search
	 */
	public function momo_wcext_woo_category_list_search() {
		global $momowsw;
		$res = check_ajax_referer( 'momowcext_security_key', 'security' );
		if ( isset( $_POST['action'] ) && 'momo_wcext_woo_category_list_search' !== $_POST['action'] ) {
			return;
		}
		$query      = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : '';
		$categories = get_terms(
			array(
				'name__like' => $query,
				'taxonomy'   => 'product_cat',
			)
		);


		$return = array();
		if ( is_array( $categories ) && ! empty( $categories ) ) :
			foreach ( $categories as $category ) :
				$title    = ( mb_strlen( $category->name ) > 50 ) ? mb_substr( $category->name, 0, 49 ) . '...' : $category->name;
				$return[] = array( $category->term_id, $title );
			endforeach;
		endif;
		echo wp_json_encode( $return );
		die;
	}
	/**
	 * Register momowcext Settings
	 */
	public function momowcext_register_settings() {
		register_setting( 'momowcext-settings-group', 'momo_wcext_settings' );
	}
	/**
	 * Set Admin Menu
	 */
	public function momo_wcext_set_admin_menu() {
		add_submenu_page(
			'woocommerce',
			esc_html__( 'WC Products to external websites', 'momowcext' ),
			'MoMo WcExt',
			'manage_options',
			'momowcext',
			array( $this, 'momowcext_add_admin_settings_page' )
		);
	}
	/**
	 * Settings Page
	 */
	public function momowcext_add_admin_settings_page() {
		global $momowcext;
		include_once $momowcext->plugin_path . 'includes/admin/pages/momo-wcext-settings.php';
	}
	/**
	 * Enqueue script and styles
	 */
	public function momowcext_print_admin_ss() {
		global $momowcext;
		wp_enqueue_style( 'momowcext_select2_style', $momowcext->plugin_url . 'assets/css/select2.min.css', array(), $momowcext->version );
		wp_enqueue_style( 'momowcext_admin_style', $momowcext->plugin_url . 'assets/css/momo_wcext_admin.css', array(), $momowcext->version );
		wp_enqueue_style( 'momowcext_boxicons', $momowcext->plugin_url . 'assets/boxicons/css/boxicons.min.css', array(), '2.1.2' );
		wp_register_script( 'momowcext_select2_script', $momowcext->plugin_url . 'assets/js/select2.min.js', array( 'jquery' ), $momowcext->version, true );
		wp_register_script( 'momowcext_admin_script', $momowcext->plugin_url . 'assets/js/momo_wcext_admin.js', array( 'jquery' ), $momowcext->version, true );
		wp_enqueue_script( 'momowcext_select2_script' );
		wp_enqueue_script( 'momowcext_admin_script' );

		$momo_wcext_settings = get_option( 'momo_wcext_settings' );
		$open_new_tab        = isset( $momo_wcext_settings['open_new_tab'] ) ? $momo_wcext_settings['open_new_tab'] : 'off';
		$ajaxurl             = array(
			'ajaxurl'              => admin_url( 'admin-ajax.php' ),
			'momowcext_ajax_nonce' => wp_create_nonce( 'momowcext_security_key' ),
			'plugin_url'           => $momowcext->plugin_url,
			'plugin_version'       => $momowcext->version,
			'site_url'             => site_url(),
			'new_window_option'    => ( 'on' === $open_new_tab ) ? true : false,
			// jQuery library needed for external website to run jQuery.
			'jquery_script'        => wp_get_script_tag(
				array(
					'src' => $momowcext->fn->momo_get_src_url( 'jquery-core' ),
				)
			),
			// Our script that runs in external website to generate and display posts/products.
			'momowcext_script'     => wp_get_script_tag(
				array(
					'src'  => esc_html( $momowcext->plugin_url ) . 'assets/js/momowcext.js?ver=' . esc_html( $momowcext->version ),
					'type' => 'text/javascript',
				)
			),
		);
		wp_localize_script( 'momowcext_admin_script', 'momowcext_admin', $ajaxurl );
	}
}
new MoMo_WC_Ext_Admin_Init();
