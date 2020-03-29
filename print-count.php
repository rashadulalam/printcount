<?php

/**
 * Plugin Name: Print Count
 * Plugin URI: http://wordpress.org/plugins/
 * Description: A plugin for tutorial practice
 * Version: 1.0
 * Author: Rashadul Alam
 * Author URI: http://about.me/rashadulalam
 * Licence: GPLv2 or later
 */

if ( ! defined( "ABSPATH" ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Print_Count
 */
final class Print_Count {
	
	/**
	 * Plugin version
	 *
	 * @var  string
	 */
	const version = '1.0';

	private function __construct() {

		$this->define_constants();

		register_activation_hook( __FILE__, [ $this, 'print_count_activation' ] );

		add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
	}

	/**
	 * Initialize the singleton instance
	 * @return Print_Count
	 */
	public static function init() {
		$instance = false;

		if( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * [print_count_activation description]
	 * @return [type] [description]
	 */
	public function print_count_activation()
	{
		$activation = new PrintCount\Installer();
		$activation->run();

	}

	public function define_constants()
	{
		define( 'PRINTCOUNT_VERSION', self::version );
		define( 'PRINTCOUNT_FILE', __FILE__ );
		define( 'PRINTCOUNT_PATH', __DIR__ );
		define( 'PRINTCOUNT_URL', plugins_url( '', PRINTCOUNT_FILE ) );
		define( 'PRINTCOUNT_ASSETS', PRINT_COUNT_URL . '/assets' );


	}

	/**
	 * Initialize the plugin
	 * @return void
	 */
	public function init_plugin()
	{	
		new PrintCount\Assets();
		
		if ( is_admin() ) {
			new PrintCount\Admin();
		} else {
			new PrintCount\Frontend();
		}
	}
}

/**
 * Initialize the main plugin
 * @return Print_Count
 */
function print_count()
{
	return Print_Count::init();
}

/**
 * Kick-off the plugin
 */
print_count();