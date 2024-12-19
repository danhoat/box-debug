<?php
function wpdb_migrate_update_url(){
    $local_url = 'http://localhost/flower';
    $site_url = home_url();
    
    global $wpdb;
    echo '<pre>';
    echo $site_url;
    
    $sql = "UPDATE wp_options SET option_value = REPLACE(option_value, '{$local_url}', '{$site_url}') WHERE option_name = 'home' OR option_name = 'siteurl'";
    echo $sql;
    $wpdb->query($sql);

    $sql = "UPDATE wp_posts SET post_content = REPLACE (post_content,  '{$local_url}', '{$site_url}' )";
    echo $sql;
    $wpdb->query($sql);
    $sql = "UPDATE wp_posts SET post_excerpt = REPLACE (post_excerpt,   '{$local_url}', '{$site_url}' )";
    echo $sql;
    $wpdb->query($sql);
    $sql = "UPDATE wp_postmeta SET meta_value = REPLACE (meta_value,   '{$local_url}', '{$site_url}' )";
    echo $sql;
    $wpdb->query($sql);
    $sql = "UPDATE wp_termmeta SET meta_value = REPLACE (meta_value,   '{$local_url}', '{$site_url}' )";
    echo $sql;
    $wpdb->query($sql);
    $sql = "UPDATE wp_comments SET comment_content = REPLACE (comment_content,   '{$local_url}', '{$site_url}' )";
    echo $sql;
    $wpdb->query($sql);
    $sql = "UPDATE wp_comments SET comment_author_url = REPLACE (comment_author_url,   '{$local_url}', '{$site_url}' )";
    echo $sql;
    $wpdb->query($sql);
    $sql = "UPDATE wp_posts SET guid = REPLACE (guid,   '{$local_url}', '{$site_url}' )";
    echo $sql;
    $wpdb->query($sql);
    echo '</pre>';


    //NOte: REPLACE(string, old_string, new_string)
}

// add_action('after_setup_theme','wpdb_migrate_update_url');
?>
