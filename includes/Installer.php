<?php

namespace PluginBoilerplate;

/**
 * Installer class
 */
class Installer {

    /**
     * Run the installer
     *
     * @return void
     */
    public function run() {
        $this->add_version();
        $this->create_tables();
    }

    /**
     * Add time and version on DB
     */
    public function add_version() {
        $installed = get_option( 'plugin_boilerplate_installed' );

        if ( ! $installed ) {
            update_option( 'plugin_boilerplate_installed', time() );
        }

        update_option( 'plugin_boilerplate_version', PLUGINBOILERPLATE_VERSION );
    }

    /**
     * Create necessary database tables
     *
     * @return void
     */
    public function create_tables() {
        global $wpdb;
        // set the default character set and collation for the table
        $charset_collate = $wpdb->get_charset_collate();

        // Check that the table does not already exist before continuing
        $sql = "";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );
        $is_error = empty( $wpdb->last_error );
        return $is_error;
    }
}
