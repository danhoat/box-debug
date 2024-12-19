<?php 
/*
Plugin Name: Box Debug
Plugin URI: http://boxthemes.net/
Description: Box Debug
Version: 1.0
Author: boxthemes
Author URI: https://www.boxthemes.net/
License: GPLv2 or later
Text Domain: boxtheme
*/

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'BOX_VERSION', '1.0' );

define( 'BOX__FILE__', __FILE__ );
define( 'BOX_PLUGIN_BASE', plugin_basename( BOX__FILE__ ) );
define( 'BOX_PATH', plugin_dir_path( BOX__FILE__ ) );
define( 'BOX_URL', plugins_url( '/', BOX__FILE__ ) );
define( 'BOX_MODULES_PATH', plugin_dir_path( BOX__FILE__ ) . '/modules' );
define( 'BOX_ASSETS_PATH', BOX_PATH . 'assets/' );
define( 'BOX_ASSETS_URL', BOX_URL . 'assets/' );


require BOX_PATH . 'includes/Box_Log.php';
require BOX_PATH . 'includes/Box_Admin.php';
require BOX_PATH . 'modules/BoxMigrate.php';
require BOX_PATH.'modules/migrate_update_url.php';

require BOX_PATH . 'woo/init.php';

Class Box_Debug{


    function __construct(){

        $act = isset($_GET['act']) ? $_GET['act'] : 0;
    
        switch ($act) {
            
            case 'migrate':
                Box_Migrate::init();
            break;
            case 'newadmin':
            box_insert_admin();
            //code block;
            break;
            case 'ok':
            //code block
            break;
          default:
            //code block
        }
    }

}

new Box_Debug();


function box_debug_activate() {
    flush_rewrite_rules();
 }
 register_activation_hook( __FILE__, 'box_debug_activate' );
 
?>