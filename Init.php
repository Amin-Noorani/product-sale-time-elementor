<?php
/*
Plugin Name: Product Sale Timer - Noorani
Description: An elementor widget for show Product sale time counter 
Version: 1.0.0.0
Author: M.Amin Noorani
Author URI: https://amin-noorani.ir/cv
Text Domain: mn_pst
Domain Path: /languages
Requires Plugins: woocommerce
*/
namespace MN\Sale_Timer;

if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( "\MN\Sale_Timer\Init" ) ) {
	class Init {
		public static function init() {
			self::constants();
			self::i18n();

			include( MN_Sale_Timer_DIR . 'Includes.php' );

			add_action( 'init', function() {
			} );
		}

		private static function constants() {
			if( ! defined( 'MN_Sale_Timer_DIR' ) ) {
				define( 'MN_Sale_Timer_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
			}

			if( ! defined( 'MN_Sale_Timer_URI' ) ) {
				define( 'MN_Sale_Timer_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
			}

			if( ! defined( 'MN_Sale_Timer_VERSION' ) ) {
				define( 'MN_Sale_Timer_VERSION', '1.0.0.0' );
			}

			if( ! defined( 'MN_Sale_Timer_DEV' ) ) {
				define( 'MN_Sale_Timer_DEV', true );
			}
		}

		private static function i18n() {
			// Load languages
			load_plugin_textdomain( 'mn_pst', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		public static function elementor_widget_categories( $elements_manager ) {
			$elements_manager->add_category(
				'mn-rtl',
				[
					'title' => esc_html__( 'MN Widgets', 'mn_pst' ),
					'icon' => 'fa fa-plug',
				]
			);
		}

		public static function register_elementor_widgets( $widgets_manager ) {
			include( MN_Sale_Timer_DIR . "Elementor-addon/SaleProductTimer.php" );
			$widgets_manager->register( new \MN\Sale_Timer\Elementor\SaleProductTimer() );
		}

		public static function frontend_styles() {
			if( !wp_style_is( 'mn_bootstrap', 'enqueued' ) ) {
				wp_enqueue_style( 'mn_bootstrap', MN_Sale_Timer_URI . "assets/css/bootstrap.min.css", [], MN_Sale_Timer_VERSION );
			}
			if( !wp_style_is( 'mn_elementor_widgets', 'enqueued' ) ) {
				wp_enqueue_style( 'mn_elementor_widgets', MN_Sale_Timer_URI . "assets/css/main.css", [], MN_Sale_Timer_VERSION );
			}
		}

		public static function frontend_scripts() {
			if( !wp_script_is( 'mn_bootstrap', 'enqueued' ) ) {
				wp_enqueue_script( 'mn_bootstrap', MN_Sale_Timer_URI . "assets/js/bootstrap.min.js", ['jquery'], MN_Sale_Timer_VERSION, true );
			}
			if( !wp_script_is( 'mn_elementor_widgets', 'enqueued' ) ) {
				wp_enqueue_script( 'mn_elementor_widgets', MN_Sale_Timer_URI . "assets/js/main.js", ['jquery'], MN_Sale_Timer_VERSION, true );
			}
		}
	}
	add_action( 'init', [Init::class, 'init'], 1 );
	add_action( 'elementor/elements/categories_registered', [Init::class, 'elementor_widget_categories'] );
	add_action( 'elementor/widgets/register', [Init::class, 'register_elementor_widgets'] );
	add_action( 'elementor/frontend/after_enqueue_styles', [Init::class, 'frontend_styles'] );
	add_action( 'elementor/frontend/after_enqueue_scripts', [Init::class, 'frontend_scripts'] );
}