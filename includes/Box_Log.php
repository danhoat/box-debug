<?php 

Class Class_Box_Log {
    
    const GENERAL_ERROR_DIR = ABSPATH.'/wp-content/box_log.log';

    public function general($s1, $s2){
         error_log( "\n" ,3, self::GENERAL_ERROR_DIR);
        if( is_string($s1) ){

            if( empty($s2) ){
                error_log('empty s2');
                $date = date('d.m.Y h:i:s');
                $msg = "Date:  ".$date." : ".$s1."\n";
                error_log($s1, 3, self::GENERAL_ERROR_DIR);
            } else {
                error_log(' s2 ok');
                $s2 = sprintf($s2);
                $new_string = $s1. ':'.$s2."\n";
                 error_log($new_string, 3, self::GENERAL_ERROR_DIR);
            }

        } else {
            
             error_log( print_r( $s1, true )."\n" ,3, self::GENERAL_ERROR_DIR);
        }
    }

}


function box_log($msg){
    $log = new Class_Box_Log();
    $log->general($msg, $msg2 = ''); //use for general errors
}