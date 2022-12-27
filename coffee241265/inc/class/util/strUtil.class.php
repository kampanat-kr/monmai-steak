<?php
    class strUtil {
        public static function nvl($str, $def = ""){
            return (self::isEmpty($str) ? $def : $str);
        }

        public static function isEmpty($str){
            if ($str == null || $str == "") return true;
            if (strlen($str) == 0) return true;
            return false;
        }

        public static function isNotEmpty($str){
           return !self::isEmpty($str);
        }
    }
?>