<?php

namespace PluginBoilerplate\Frontend;

/**
 * Shortcode handler class
 */
class Shortcode {

    /**
     * Initializes the class
     */
    function __construct() {
        add_shortcode( 'plugin-boilerplate', [ $this, 'render_shortcode' ] );
    }

    /**
     * Shortcode handler class
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_shortcode( $atts, $content = '' ) {
        
        
        
        
        wp_enqueue_script( 'plugin-boilerplate-script' );
        wp_enqueue_style( 'plugin-boilerplate-style' );

        return '<div class="plugin-boilerplate-shortcode">Hello from Shortcode</div>';
    }
}
