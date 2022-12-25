<?php
		@session_start();
		class user_session{
        const ORG_NAME = "_ORG_NAME";
        const LOG_ID = "_LOG_ID";
        const USER_LOGIN = "_USER_LOGIN";
        const USER_NAME = "_USER_NAME";
        const USER_ID = "_USER_ID";
		const DEALER_CODE = "_DEALER_CODE";
		const ACCESS_GROUP = "_ACCESS_GROUP";
		const LANGUAGE = "_LANGUAGE";
		const DIV_ID = "_DIV_ID";
		const DIVG1 = "_DIVG1";
		const DIVG2 = "_DIVG2";
		const DIVG3 = "_DIVG3";
		const CR = "_CR";
		const TN = "_TN";
		const VERSION = "_VERSION";
		const ORG = "_ORG";
		const ADDRESS = "_ADDRESS";
		const YC = "_YC";
	  const SCRIME = "_SCRIME";
		const hoscode = "_hoscode";
		const CID = "_CID";

        public static function set_org_name($value){
            $_SESSION[self::ORG_NAME] = $value;
        }
        public static function get_org_name(){
            return $_SESSION[self::ORG_NAME];
        }
        //----------------------------
        public static function set_log_id($value){
            $_SESSION[self::LOG_ID] = $value;
        }

        public static function get_log_id(){
            return $_SESSION[self::LOG_ID];
        }
        public static function set_user_login($value){
            $_SESSION[self::USER_LOGIN] = $value;
        }

        public static function get_user_login(){
            return $_SESSION[self::USER_LOGIN];
        }

        public static function set_user_name($value){
            $_SESSION[self::USER_NAME] = $value;
        }

        public static function get_user_name(){
            return $_SESSION[self::USER_NAME];
        }

        public static function set_user_id($value){
            $_SESSION[self::USER_ID] = $value;
        }

        public static function get_user_id(){
            return $_SESSION[self::USER_ID];
        }

        public static function set_dealer_code($value){
            $_SESSION[self::DEALER_CODE] = $value;
        }

        public static function get_dealer_code(){
            return $_SESSION[self::DEALER_CODE];
        }

        public static function set_access_group($value){
            $_SESSION[self::ACCESS_GROUP] = $value;
        }

        public static function get_access_group(){
            return $_SESSION[self::ACCESS_GROUP];
        }

        public static function set_language($value){
            $_SESSION[self::LANGUAGE] = $value;
        }
        public static function get_language(){
            return $_SESSION[self::LANGUAGE];
        }

	public static function set_div_id($value){
            $_SESSION[self::DIV_ID] = $value;
        }
        public static function get_div_id(){
            return $_SESSION[self::DIV_ID];
        }

	public static function set_scrime($value){
		$_SESSION[self::SCRIME] = $value;
	}
	public static function get_scrime(){
		return $_SESSION[self::SCRIME];
	}

	public static function set_hoscode($value){
		$_SESSION[self::hoscode] = $value;
	}
	public static function get_hoscode(){
		return $_SESSION[self::hoscode];
	}

	public static function set_CID($value){
		$_SESSION[self::CID] = $value;
	}
	public static function get_CID(){
		return $_SESSION[self::CID];
	}







    }
?>
