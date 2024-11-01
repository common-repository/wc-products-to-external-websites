<?php
/**
 * Plugin Name: Link Products to External websites for WooCommerce
 * Description: Display WooCommerce products to other external websites.
 * Text Domain: momowcext
 * Domain Path: /languages
 * Version: 1.0.0
 * Author URI: http://www.momothemes.com/
 * Requires at least: 5.7
 * Tested up to: 6.0.1
 */
class MoMo_WC_External {
	/**
	 * Plugin Version
	 *
	 * @var string
	 */
	public $version = '1.0.0';
	/**
	 * Plugin Slug
	 *
	 * @var string
	 */
	public $slug = 'momowcext';
	/**
	 * Constructor
	 */
	public function __construct() {
		define( 'MOMO_WCEXT_PATH', dirname( __FILE__ ) );
		add_action( 'plugins_loaded', array( $this, 'momowcext_plugin_loaded' ) );
	}
	/**
	 * Plugin Loaded
	 */
	public function momowcext_plugin_loaded() {
		$this->plugin_url    = plugin_dir_url( __FILE__ );
		$this->plugin_path   = dirname( __FILE__ ) . '/';
		$this->template_url  = $this->plugin_url . 'templates/';
		$this->template_path = 'templates/';
		$this->name          = esc_html__( 'WC Products to External Websites', 'momowcext' );
		add_action( 'init', array( $this, 'momowcext_plugin_init' ), 0 );
	}
	/**
	 * Plugin Init
	 *
	 * @return void
	 */
	public function momowcext_plugin_init() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			add_action( 'admin_notices', array( $this, 'momo_wcext_no_wc_notice' ) );
		} else {
			include_once 'includes/class-momo-wcext-products.php';
			include_once 'includes/class-momo-wcext-api.php';
			include_once 'includes/class-momo-wcext-styles.php';
			include_once 'includes/class-momo-wcext-functions.php';

			$this->wc     = new Momo_WC_Ext_Products();
			$this->api    = new Momo_WC_Ext_API();
			$this->styles = new Momo_WC_Ext_Styles();
			$this->fn     = new MoMo_WC_Ext_Functions();
			if ( is_admin() ) {
				include_once 'includes/admin/class-momo-wcext-admin-init.php';
			}
		}
	}
	/**
	 * Notify if WooCommerce is not there
	 */
	public function momo_wcext_no_wc_notice() {
		?>
		<div class="message error">
			<p>
				<?php
				esc_html_e( 'This plugin needs WooCommerce plugin to display product(s). Please install WooCommerce first', 'momowcext' );
				?>
			</p>
		</div>
		<?php
	}
}
$GLOBALS['momowcext'] = new MoMo_WC_External();
