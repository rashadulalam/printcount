<?php

namespace PrintCount;

/**
 * Assets
 */
class Assets
{
	
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );
	}

	public function get_scripts() {
		return [
			'printcount-admin-script' => [
				'src'     => PRINTCOUNT_ASSETS . '/js/admin.js',
				'version' => filemtime( PRINTCOUNT_PATH . '/assets/js/admin.js'),
				'deps'    => [ 'jquery', 'wp-util' ],
			],
			'printcount-frontend-script' => [
				'src'     => PRINTCOUNT_ASSETS . '/js/frontend.js',
				'version' => filemtime( PRINTCOUNT_PATH . '/assets/js/frontend.js'),
				'deps'    => [ 'jquery' ],
			],
			'printcount-enquery-script' => [
				'src'     => PRINTCOUNT_ASSETS . '/js/enquery.js',
				'version' => filemtime( PRINTCOUNT_PATH . '/assets/js/enquery.js'),
				'deps'    => [ 'jquery' ],
			]
		];
	}

	public function get_styles()
	{
		return [
			'printcount-frontend-style' => [
				'src' => PRINTCOUNT_ASSETS . '/css/frontend.css',
				'version' => filemtime( PRINTCOUNT_PATH . '/assets/css/frontend.css')
			],
			'printcount-admin-style' => [
				'src' => PRINTCOUNT_ASSETS . '/css/admin.css',
				'version' => filemtime( PRINTCOUNT_PATH . '/assets/css/admin.css')
			],
			'printcount-enquery-style' => [
				'src' => PRINTCOUNT_ASSETS . '/css/enquery.css',
				'version' => filemtime( PRINTCOUNT_PATH . '/assets/css/enquery.css')
			]
		];
	}

	public function register_assets()
	{
		$scripts = $this->get_scripts();
		$styles = $this->get_styles();


		// script
		foreach ($scripts as $handle => $script) {
				
			$deps = isset( $script['deps'] ) ? $script['deps'] : false;

			wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
		}


		// styles
		foreach ($styles as $handle => $style) {
			$deps = isset( $style['deps'] ) ? $style['deps'] : false;
			wp_register_style( $handle, $style['src'], $deps, $style['version'] );
		}
	}
}