<?php
    class dateUtil {
        const DIFF_IN_YEAR = "Y";
        const DIFF_IN_MONTH = "M";
        const DIFF_IN_DAYS = "D";
        const DIFF_IN_HOURS  = "H";
        const DIFF_IN_MINUTES = "I";
        const DIFF_IN_SECONDS = "S";
        
        public static function time_hms($time){
            if(trim($time) == ""){
                return "";
            }

            $h = substr($time, 0, 2);
            $m = substr($time, 2, 2);
            $s = substr($time, 4, 2);

            return "$h:$m:$s";
        }

        public static function date_dmy($date){
            if(trim($date) == ""){
                return "";
            }

            $d = substr($date, 6, 2);
            $m = substr($date, 4, 2);
            $y = substr($date, 0, 4);

            return "$d-$m-$y";
        }

        public static function date_ymd($date){
            if(trim($date) == ""){
                return "";
            }

            $d = substr($date, 0, 2);
            $m = substr($date, 3, 2);
            $y = substr($date, 6, 4);

            return "$y$m$d";
        }
        
        public static function date_ymdhms($date){
            if(trim($date) == ""){
                return "";
            }

            return date("YmdHis", strtotime($date));
        }

        public static function date_dmyhms($date){
            if(trim($date)==""){
                return "";
            }

            $d = substr($date, 6, 2);
            $m = substr($date, 4, 2);
            $y = substr($date, 0, 4);
            $h = str_pad(substr($date, 8, 2), 2, "0", STR_PAD_LEFT);
            $i = str_pad(substr($date, 10, 2), 2, "0", STR_PAD_LEFT);
            $s = str_pad(substr($date, 12, 2), 2, "0", STR_PAD_LEFT);

            return "$d-$m-$y  $h:$i:$s";
        }

        public static function date_time($txt_date,$txt_time) {
            return self::date_dmy($txt_date)." ".self::time_hms($txt_time);
        }

        public static function current_date_time(){
            return date("Ymd").date("His");
        }

        public static function current_date(){
            return date("Ymd");
        }

        public static function getFirstDayFromWeek($year, $week) {
            $first_day = strtotime($year."-01-01");
            $is_monday = date("w", $first_day) == 1;
            $is_weekone = strftime("%V", $first_day) == 1;
            if($is_weekone){
                $week_one_start = $is_monday ? strtotime("last monday", $first_day) : $first_day;
            } else {
                $week_one_start = strtotime("next monday", $first_day);
            }

            return $week_one_start + (3600 * 24 * 7 *($week-1));
        }
        
        public static function getWeekRange($year, $week) {
            $start_date = dateUtil::getFirstDayFromWeek($year, $week);
            $end_date = strtotime(date("Ymd", $start_date)." +6 day");

            return array($start_date, $end_date);
        }

        public static function getMonthRange($year, $month) {
            $start_date = mktime(0, 0, 0, $month, 1, $year);
            $end_date = mktime(23, 59, 0, $month, date('t', $start_date), $year);

            $start_date = date("Ymd", $start_date);
            $end_date = date("Ymd", $end_date);

            return array($start_date, $end_date);
        }

        public static function dateDiff($d1, $d2, $diffin= self::DIFF_IN_DAYS){
            switch ($diffin) {
                case self::DIFF_IN_YEAR : // year
                    $divide = 31536000;
                    break;

                case self::DIFF_IN_MONTH : // month
                    $divide = 2628000;
                    break;

                case self::DIFF_IN_DAYS : // day
                    $divide = 60 * 60 * 24;
                    break;

                case self::DIFF_IN_HOURS : // hours
                    $divide = 60 * 60;
                    break;

                case self::DIFF_IN_MINUTES : // minutes
                    $divide = 60;
                    break;

                case self::DIFF_IN_SECONDS : // seconds
                    $divide = 1;
                    break;

                default:
                    $divide = 60 * 60 * 24;
                    break;
            }

            return round(abs(strtotime($d1) - strtotime($d2)) / $divide);
        }
    }

?>