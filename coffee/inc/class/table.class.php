<?php
    class table {
        public static function row_color($num){
            //return ($num%2) ? "#D5DBC0" : "#E6EAD7";
            return ($num%2) ? "#DBE0CB" : "#E6EAD7";
        }

        public static function fnc_row_mouse_event($num){
            $color = ($num%2) ? "#DBE0CB" : "#E6EAD7";
            $style = " style=\"background-color: $color\""
                       . " onmousemove=\"row_mouseover(this)\""
                       . " onmouseout=\"row_mouseout(this)\"";
            return $style;
        }
    }
?>
