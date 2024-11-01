<?php
/**
 * Styles used for Ext. Event Display
 *
 * @author   MoMo Themes
 * @version  1.0.0
 * @package  momowcext
 */
class Momo_WC_Ext_Styles {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->opt      = get_option( 'momowcext_options' );
		$os             = isset( $this->opt['general']['momowcext_theme_select'] ) ? $this->opt['general']['momowcext_theme_select'] : '';
		$this->selected = 'red';
		switch ( $os ) {
			case '1':
				$this->selected = 'red';
				break;
			case '2':
				$this->selected = 'purple';
				break;
			case '3':
				$this->selected = 'navy';
				break;
			case '4':
				$this->selected = 'green';
				break;
			case '5':
				$this->selected = 'dark';
				break;
			default:
				$this->selected = 'red';
		}
	}
	/**
	 * Generate Single Styles
	 */
	public function momo_wcext_generate_category_styles() {
		ob_start();
		?>
		@import url(https://fonts.googleapis.com/css?family=Montserrat&display=swap);
		ul.momowcext_venues_list_box{
			list-style: none;
			font-family: 'Montserrat', sans-serif;
			margin: 0 auto;
			padding: 0;
			max-width: 290px;
		}
		a.momowcext_sidebar_anchor_venue{
			text-decoration: none;
		}
		.momowcext_sidebar_anchor_venue li{
			margin-bottom: 12px;
			padding: 8px;
			position: relative;
		}
		.momowcext_sidebar_anchor_venue li:before{
			content:'';
			background: <?php echo $this->momo_wcext_tc( $this->selected, 'linvenue' ); ?>;
			position:absolute;
			width:100%;
			height:3px;
			top:8px;
			left:0;
		}
		.momowcext_sidebar_anchor_venue li .momowcext_venue_title{
			display: block;
			font-weight: bolder;
			color: #464646;
		}
		.momowcext_sidebar_anchor_venue li .momowcext_venue_address,
		.momowcext_sidebar_anchor_venue li .momowcext_venue_city,
		.momowcext_sidebar_anchor_venue li .momowcext_venue_country,
		.momowcext_sidebar_anchor_venue li .momowcext_venue_zip,
		.momowcext_sidebar_anchor_venue li .momowcext_venue_phone{
			display: block;
			line-height: 12px;
			font-size: 12px;
			color: #464646;
		}
		.momowcext_footer_info_venue{
			display: block;
			text-align: center;
			margin-top: 22px;
			border-top: 1px solid #cecece;
		}
		.momowcext_footer_info_venue a{
			text-decoration: none;
		}
		.momowcext_footer_info_venue a:focus{
			text-decoration: none;
			outline: none;
			color: inherit;
		}
		<?php
		return ob_get_clean();
	}
	/**
	 * Generate Single Styles
	 */
	public function momo_wcext_generate_single_styles() {
		ob_start();
		?>
		@import url(https://fonts.googleapis.com/css?family=Montserrat&display=swap);
		.momo_wcext_global_container{
			font-family: 'Montserrat', sans-serif;
		}
		.momo_wcext_global_container.momo-single-product ul.products{
			margin-left: 0;
			margin-bottom: 0;
			clear: both;
			list-style: none;
		}
		.momo_wcext_global_container.momo-single-product ul.products li a{
			position: relative;
			overflow: hidden;
		}
		.momo_wcext_global_container.momo-single-product ul.products li a::before,
		.momo_wcext_global_container.momo-single-product ul.products li a::after{
			content: "";
			display: table;
		}
		.momo_wcext_global_container.momo-single-product ul.products::before,
		.momo_wcext_global_container.momo-single-product ul.products::after{
			content: "";
			display: table;
		}
		.momo_wcext_global_container.momo-single-product .momo-single-image-container{
			width: 41.1764705882%;
			float: left;
			margin-right: 5.8823529412%;
			margin-bottom: 3.706325903em;
		}
		.momo_wcext_global_container.momo-single-product ul.products li.product a.woocommerce-LoopProduct-link{
			display: block;
			text-decoration: none;
			color: #6d6d6d;
		}
		.momo_wcext_global_container.momo-single-product ul.products li.product .momo-single-right{
			width: 52.9411764706%;
			float: right;
			margin-right: 0;
		}
		.momo_wcext_global_container.momo-single-product ul.products li.product img{
			display: block;
			margin: 0 auto 1.618em;
			height: auto;
			max-width: 100%;
		}
		.momo_wcext_global_container.momo-single-product .onsale{
			border: 1px solid;
			border-color: #43454b;
			color: #43454b;
			padding: .202em .6180469716em;
			font-size: .875em;
			text-transform: uppercase;
			font-weight: 600;
			display: inline-block;
			margin-bottom: 1em;
			border-radius: 3px;
			position: relative;
			color: #6d6d6d;
		}
		<?php
		return ob_get_clean();
	}
	/**
	 * Generate Styles
	 */
	public function momo_wcext_generate_styles() {
		ob_start();
		?>
		@import url(https://fonts.googleapis.com/css?family=Montserrat&display=swap);
		.momo_wcext_global_container{
			font-family: 'Montserrat', sans-serif;
		}
		.momo_wcext_global_container.momo-multiple-products ul.products{
			margin-left: 0;
			margin-bottom: 0;
			clear: both;
			list-style: none;
		}
		.momo_wcext_global_container.momo-multiple-products ul.products::before,
		.momo_wcext_global_container.momo-multiple-products ul.products::after{
			content: "";
			display: table;
		}
		.momo_wcext_global_container.momo-multiple-products ul.products::after {
			clear: both;
		}

		.momo_wcext_global_container.momo-multiple-products ul.products.columns-3 li.product {
			width: 29.4117647059%;
			float: left;
			/*margin-right: 5.8823529412%; */
			margin-right: 3.882%;
			font-size: .875em;
			list-style: none;
			text-align: center;
		}
		.momo_wcext_global_container.momo-multiple-products ul.products li.product a.woocommerce-LoopProduct-link{
			display: block;
			text-decoration: none;
		}
		.momo_wcext_global_container.momo-multiple-products ul.products li.product img{
			display: block;
			margin: 0 auto 1.618em;
			height: auto;
			max-width: 100%;
		}
		.momo_wcext_global_container.momo-multiple-products ul.products li.product .woocommerce-loop-product__title{
			font-size: 1rem;
			font-weight: 400;
			margin-bottom: .5407911001em;
			color: #333333;
		}
		.momo_wcext_global_container.momo-multiple-products .onsale{
			border: 1px solid;
			border-color: #43454b;
			color: #43454b;
			padding: .202em .6180469716em;
			font-size: .875em;
			text-transform: uppercase;
			font-weight: 600;
			display: inline-block;
			margin-bottom: 1em;
			border-radius: 3px;
			position: relative;
			color: #6d6d6d;
		}
		.momo_wcext_global_container.momo-multiple-products ul.products li.product .price{
			display: block;
			color: #6d6d6d;
			font-weight: 400;
			margin-bottom: 1rem;
		}
		<?php
		return ob_get_clean();
	}
	/**
	 * Return Theme Color
	 *
	 * @param string $theme Theme Name.
	 * @param string $place Where.
	 */
	public function momo_wcext_tc( $theme, $place = 'normal' ) {
		switch ( $place ) {
			case 'normal':
				switch ( $theme ) {
					case 'red':
						return 'rgb(197,44,102)';
					case 'navy':
						return 'rgb(24, 24, 121)';
					case 'purple':
						return 'rgb(130, 70, 175)';
					case 'green':
						return 'rgb(82, 138, 70)';
					case 'dark':
						return 'rgb(23, 52, 54)';
					default:
						return 'rgb(197,44,102)';
				}
				break;
			case 'lin':
				switch ( $theme ) {
					case 'red':
						return 'linear-gradient(to left, rgb(127,44,102), rgba(255, 17, 28, 0.25)), rgb(197,44,102)';
					case 'navy':
						return 'linear-gradient(to left, rgb(24, 24, 121), rgba(76, 81, 157, 0.25)), rgb(117, 97, 162)';
					case 'purple':
						return 'linear-gradient(to left, rgb(130, 70, 175), rgba(76, 81, 157, 0.25)), rgb(117, 97, 162)';
					case 'green':
						return 'linear-gradient(to left, rgb(82, 138, 70), rgba(76, 81, 157, 0.25)), rgb(131, 176, 114)';
					case 'dark':
						return 'linear-gradient(to left, rgb(23, 52, 54), rgba(30, 29, 29, 0.25)), rgb(96, 86, 89)';
					default:
						return 'linear-gradient(to left, rgb(127,44,102), rgba(255, 17, 28, 0.25)), rgb(197,44,102)';
				}
				break;
			case 'linvenue':
				switch ( $theme ) {
					case 'red':
						return 'linear-gradient(to right, rgb(197,44,102), rgba(255, 17, 28, 0.25) )';
					case 'navy':
						return 'linear-gradient(to right, rgb(24, 24, 121), rgba(76, 81, 157, 0.25) )';
					case 'purple':
						return 'linear-gradient(to right, rgb(130, 70, 175), rgba(76, 81, 157, 0.25) )';
					case 'green':
						return 'linear-gradient(to right, rgb(82, 138, 70), rgba(49, 202, 17, 0.14) )';
					case 'dark':
						return 'linear-gradient(to right, rgb(23, 52, 54), rgba(30, 29, 29, 0.25) )';
					default:
						return 'linear-gradient(to right, rgb(197,44,102), rgba(255, 17, 28, 0.25) )';
				}
		}
	}
}
