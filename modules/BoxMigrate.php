<?php

Class Box_Migrate{

    private static $instances = [];
    public $old_url;
    public $new_url;
    
    function __construct(){
        $this->old_url = 'https://codienminhdat.vn';
        $this->new_url = home_url();
    }
    public static function getInstance(): Box_Migrate {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
    static function init(){
        global $wpdb;
        $self       = Box_Migrate::getInstance();
        $queries    = $self->sql_query();
        // echo '<pre>';
        // var_dump($queries);
        // echo '</pre>';
        // die();
        foreach($queries as $sql){
             //$wpdb->query($sql);
        }
    }
    function sql_query(){
        global $wpdb;
        $args = array();

        $args[] = $wpdb->prepare("UPDATE wp_options SET option_value = REPLACE(option_value, %s,  %s) WHERE option_name = 'home' OR option_name = 'siteurl'",$this->old_url, $this->new_url);
        $args[] = $wpdb->prepare("UPDATE wp_posts SET post_content = REPLACE (post_content,  %s,  %s)",$this->old_url, $this->new_url);

        $args[] = $wpdb->prepare("UPDATE wp_posts SET post_excerpt = REPLACE (post_excerpt, %s,  %s)",$this->old_url, $this->new_url);

        $args[] = $wpdb->prepare("UPDATE wp_postmeta SET meta_value = REPLACE (meta_value,  %s,  %s)",$this->old_url, $this->new_url);
        $args[] = $wpdb->prepare("UPDATE wp_termmeta SET meta_value = REPLACE (meta_value, %s,  %s)", $this->old_url, $this->new_url);

        $args[] = $wpdb->prepare("UPDATE wp_comments SET comment_content = REPLACE (comment_content,  %s,  %s)",$this->old_url, $this->new_url);
        $args[] = $wpdb->prepare("UPDATE wp_comments SET comment_author_url = REPLACE (comment_author_url, %s,  %s)", $this->old_url, $this->new_url );
        $args[] = $wpdb->prepare("UPDATE wp_posts SET guid = REPLACE (guid,   %s,  %s) WHERE post_type = 'attachment')", $this->old_url, $this->new_url);

        return $args;
    }
}
?>