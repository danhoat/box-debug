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

Class Box_Debug{
    protected $act;
    function __construct(){
        $this->act = isset($_GET['act']) ? $_GET['act'] : '';
       
    }

}
new Box_Debug();

function box_debug_activate() {

    global $myvar;
    echo $myvar; // this will be 'whatever'
    flush_rewrite_rules();
 }
 register_activation_hook( __FILE__, 'box_debug_activate' );
 
?>