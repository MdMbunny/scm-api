<?php
/**
 * Plugin Name:         SCM API
 * Plugin URI:          http://studiocreativo-m.it/
 * Description:         SCM Plugin Description
 * Version:             1.0.1
 * Author:              Studio Creativo M
 * Author URI:          http://studiocreativo-m.it/
 * License:             http://www.gnu.org/licenses/gpl-3.0.html
 * GitHub Plugin URI:   MdMbunny/scm-api
 * GitHub Branch:       master
 */

// *****************************************************
// *      0.0 INIT - [AUTOMATIC - DO NOT TOUCH]
// *****************************************************

    add_action( 'plugins_loaded', 'scm_plugin_init' );

    // Init Plugin
    if ( ! function_exists( 'scm_plugin_init' ) ) {
        function scm_plugin_init($file){
            //print( $file . ' FROM ' . __FILE__ );
            $file = ( $file ?: __FILE__ );
            $plugin = scm_plugin_name( $file );
            $slug = sanitize_title( $plugin );
            $name = strtoupper( str_replace( '-', '_', $slug ) );
            $dir = dirname( $file ) . '/';
            $uri = plugin_dir_url( $file );

            // PLUGIN CONSTANTS
            define( $name,                             $slug );
            define( $name . '_VERSION',                scm_plugin_version( $file ) );
            define( $name . '_DIR',                    $dir );
            define( $name . '_URI',                    $uri );
            define( $name . '_DIR_ASSETS',             $dir . 'assets/' );
            define( $name . '_URI_ASSETS',             $uri . 'assets/' );
            define( $name . '_DIR_LANG',               $dir . 'lang/' );
            define( $name . '_URI_LANG',               $uri . 'lang/' );

            // PLUGIN TEXTDOMAIN
            load_plugin_textdomain( $slug, false, $dir . 'lang/' );
        }
    }else{
        //print('ALREADY EXISTS, SO...');
        scm_plugin_init( __FILE__ );
    }

    // Get Plugin Data
    if ( ! function_exists( 'scm_plugin_data' ) ) {
        // All Data
        function scm_plugin_data( $file ) {
            if ( ! function_exists( 'get_plugins' ) )
                require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            $plugin_folder = get_plugins( '/' . plugin_basename( dirname( $file ) ) );
            $plugin_file = basename( ( $file ) );
            return $plugin_folder[ $plugin_file ];
        }
        // Name
        function scm_plugin_name( $file ) {
            $plug = scm_plugin_data( $file );
            return $plug[ 'Name' ];
            //return scm_plugin_data( $file )[ 'Name' ];
        }
        // Version
        function scm_plugin_version( $file ) {
            $plug = scm_plugin_data( $file );
            return $plug[ 'Version' ];
            //return scm_plugin_data( $file )[ 'Version' ];
        }
    }
    

// ***************************************************************************************************************************************************************
// ***************************************************************************************************************************************************************
// *** CUSTOM CODE GOES HERE *************************************************************************************************************************************
// ***************************************************************************************************************************************************************
// ***************************************************************************************************************************************************************


/*
*****************************************************
*
*   0.0 Actions and Filters
*   1.0 Assets
*
*****************************************************
*/

add_action( 'scm_action_content_none', 'scm_api_redirect' );

// *****************************************************
// *      0.0 ACTIONS AND FILTERS
// *****************************************************

function scm_api_redirect( $screen ){
    if( endsWith( $screen, '/API' ) ){
        wp_redirect( SCM_API_URI . 'API/index.html' );
        exit;
    }
}

// *****************************************************
// *      1.0 ASSETS
// *****************************************************