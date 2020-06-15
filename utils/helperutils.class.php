<?php

define ('SCREEN_OPTION_SEPARATOR', '_');

class HelperUtils {

    private function __construct() {
        //
    }
 
    public static function mergeObjectWithArray( &$obj, $array) {
        foreach ($array as $key => $value) {
            if( is_string ( $key ) && property_exists ( $obj , $key )) {
                $obj->$key = $value;
            }
        }    
        return $obj;
    }

    public static function generateMD5($string) {
        $name = isset($string) ? $string : self::randomString(10);
        return md5($name . (new \DateTime(null, new DateTimeZone('Europe/Warsaw')))->format('Y-m-d H:i:s.u'));
    } 

    public static function randomString($cnt) {
        $name = isset($cnt) ? $cnt : 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $cnt; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

    public static function now() {
        return (new \DateTime(null, new DateTimeZone('Europe/Berlin')))->format('Y-m-d H:i:s.u');
    }
}

?>