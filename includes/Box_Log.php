<?php 

Class Class_Box_Log {
    
    const GENERAL_ERROR_DIR = ABSPATH.'/wp-content/box_log.log';

    public function general($msg)
    {
        if( is_string($msg) ){

            $date = date('d.m.Y h:i:s');
            $msg = "Date:  ".$date." : ".$msg." \n";
            error_log($msg, 3, self::GENERAL_ERROR_DIR);
        } else {
            error_log( print_r( $msg, true ) ,3, self::GENERAL_ERROR_DIR);
        }
    }



}
function box_log($msg){
    $log = new Class_Box_Log();
    $log->general($msg); //use for general errors
}