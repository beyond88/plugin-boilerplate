<?php

namespace PluginBoilerplate;

/**
 * Assets handlers class
 */
class Assets {

    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function get_scripts() {
        return [
            'plugin-boilerplate-script' => [
                'src'     => PLUGINBOILERPLATE_ASSETS . '/js/frontend.js',
                'version' => filemtime( PLUGINBOILERPLATE_PATH . '/assets/js/frontend.js' ),
                'deps'    => [ 'jquery' ]
            ],
            'plugin-boilerplate-admin-script' => [
                'src'     => PLUGINBOILERPLATE_ASSETS . '/js/admin.js',
                'version' => filemtime( PLUGINBOILERPLATE_PATH . '/assets/js/admin.js' ),
                'deps'    => [ 'jquery', 'wp-util' ]
            ],
        

        ];
    }

    /**
     * All available styles
     *
     * @return array
     */
    public function get_styles() {
        return [
            'plugin-boilerplate-style' => [
                'src'     => PLUGINBOILERPLATE_ASSETS . '/css/frontend.css',
                'version' => filemtime( PLUGINBOILERPLATE_PATH . '/assets/css/frontend.css' )
            ],
            'plugin-boilerplate-admin-style' => [
                'src'     => PLUGINBOILERPLATE_ASSETS . '/css/admin.css',
                'version' => filemtime( PLUGINBOILERPLATE_PATH . '/assets/css/admin.css' )
            ],
            'plugin-boilerplate-daterangepicker' => [
                'src'     => PLUGINBOILERPLATE_ASSETS . '/css/daterangepicker.css',
                'version' => filemtime( PLUGINBOILERPLATE_PATH . '/assets/css/daterangepicker.css' )
            ],
        ];
    }

    /**
     * Register scripts and styles
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles  = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_enqueue_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_enqueue_style( $handle, $style['src'], $deps, $style['version'] );
        }

        wp_localize_script( 'plugin-boilerplate-admin-script', 'plugin_boilerplate', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce( 'plugin-boilerplate-admin-nonce' ),
            'confirm' => __( 'Are you sure?', 'plugin-boilerplate' ),
            'error' => __( 'Something went wrong', 'plugin-boilerplate' )
        ] );
    }
}
