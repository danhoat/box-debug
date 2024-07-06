<?php
/**
 * Plugin Name: Convert 1 image  To Attachment Post
 * Version: 1.0.0
 * Author: BuddyBoss
 * Author URI:  https://www.buddyboss.com
 *
 * @package BuddyBoss\Core
 */

/**
 * Dùng để download 1 img từ site khác về site của mình.

*/

function box_clone_image_from_url($image_url){
	return media_sideload_image($file_url, 0, null, 'id');
}



/**
 * Clone an avatar image to 1 attachmen post + insert new record in custom table. 
 * Dùng để clone 1 ảnh trong site của mình thành attachment.
 * 
 **/

function box_clone_image_from_path($image_path){

	$image_path = '/home/domains/abc.com/wp-content/uploads/abc.jpg';

	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );


	$dir 				= wp_upload_dir();
	$upload_path 		= $dir['path']; // .../2024/07
	$upload_url 		= $dir['url']; //https://diendantamly.com/wp-content/uploads/2024/07
	$basedir 			= $dir['basedir']; // /home/u502250247/domains/diendantamly.com/public_html/wp-content/uploads
	$file_name 			= basename($file_url);
	$new_file   	= wp_unique_filename( $upload_path, $file_name );
	$new_file_path 	= $upload_path.'/'.$new_file;
	$new_file_url 	= $upload_url.'/'.$new_file;



	copy($image_path, $new_file_path);

	$filetype 	= wp_check_filetype( $file_name, null );
	$attachment = array(
		'guid'           => $new_file_url, 
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace( '/\.[^.]+$/', '', $file_name ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);
	$attach_id 		= wp_insert_attachment( $attachment, $new_file_path, 0 );
	$attach_data 	= wp_generate_attachment_metadata( $attach_id, $new_file_path );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	
}