<?php

Clas Box_Migrate{

    public $old_url;
    public $new_url;
    
    function __construct(){
        $this->old_url = 'https://codienminhdat.vn';
        $this->new_url = home_url();
    }
    function init(){
        global $wpdb;
        $queries = $this->sql_query();
        foreach($queries as $sql){
            $wpdb->query($sql);
        }
    }
    function sql_query(){
        $args = array();

        $args[] = "UPDATE wp_options SET option_value = REPLACE(option_value, $this->old_url,  $this->new_url) WHERE option_name = 'home' OR option_name = 'siteurl'";
        $args[] = "UPDATE wp_posts SET post_content = REPLACE (post_content,  $this->old_url, $this->new_url)";
        $args[] = "UPDATE wp_posts SET post_excerpt = REPLACE (post_excerpt,  $this->old_url, $this->new_url)";
        $args[] = "UPDATE wp_postmeta SET meta_value = REPLACE (meta_value,  $this->old_url,$this->new_url)";
        $args[] = "UPDATE wp_termmeta SET meta_value = REPLACE (meta_value,  $this->old_url,$this->new_url)";
        $args[] = "UPDATE wp_comments SET comment_content = REPLACE (comment_content,  $this->old_url, $this->new_url)";
        $args[] = "UPDATE wp_comments SET comment_author_url = REPLACE (comment_author_url,  $this->old_url,$this->new_url)";
        $args[] = "UPDATE wp_posts SET guid = REPLACE (guid,  $this->old_url, $this->new_url) WHERE post_type = 'attachment'";

        return $args;
    }
}
?>