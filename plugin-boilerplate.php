<?php
/**
 * Plugin Name: Plugin Boilerplate
 * Description: A ready plugin boilerplate to reduce your development time.
 * Plugin URI: https://github.com/beyond88/plugin-boilerplate
 * Author: Getonnet
 * Author URI: hhttps://github.com/beyond88/
 * Version: 1.0.0
 * Text Domain:       plugin-boilerplate
 * Domain Path:       /languages
 * Requires PHP:      5.6
 * Requires at least: 4.4
 * Tested up to:      6.2
 *
 * WC requires at least: 3.1
 * WC tested up to:   5.1.0
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

use Plugin_Boilerplate\Admin\WooCommerce;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class PluginBoilerplate {

    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0';

    /**
     * Class constructor
     */
    private function __construct() {
        //REMOVE THIS AFTER DEV
        error_reporting(E_ALL ^ E_DEPRECATED);

        $this->define_constants();

        register_activation_hook( PLUGINBOILERPLATE_FILE, [ $this, 'activate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Initializes a singleton instance
     *
     * @return \PluginBoilerplate
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'PLUGINBOILERPLATE_VERSION', self::version );
        define( 'PLUGINBOILERPLATE_FILE', __FILE__ );
        define( 'PLUGINBOILERPLATE_PATH', __DIR__ );
        define( 'PLUGINBOILERPLATE_URL', plugins_url( '', PLUGINBOILERPLATE_FILE ) );
        define( 'PLUGINBOILERPLATE_ASSETS', PLUGINBOILERPLATE_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        new Plugin_Boilerplate\Assets();

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new Plugin_Boilerplate\Ajax();
        }

        new Plugin_Boilerplate\Admin();
        new Plugin_Boilerplate\Frontend();

        new Plugin_Boilerplate\API();
    }

    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installer = new Plugin_Boilerplate\Installer();
        $installer->run();
    }
}

/**
 * Initializes the main plugin
 */
function PluginBoilerplate() {
    return PluginBoilerplate::init();
}

// kick-off the plugin
PluginBoilerplate();