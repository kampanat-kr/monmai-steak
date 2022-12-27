<?php
error_reporting (E_ALL ^ E_NOTICE);
include_once dirname(__FILE__)."/config.inc.php";
include_once dirname(__FILE__)."/class/user_session.class.php";
include_once dirname(__FILE__)."/class/php_header.class.php";

//$access_group = trim(user_session::get_access_group());
$access_rolename = trim(user_session::get_dealer_code());
$DivIds = trim(user_session::get_div_id());
$UserNmame_ = trim(user_session::get_user_name());
$UserNmame = substr($UserNmame_, 0,1);
$UserNmame_amp = substr($UserNmame_, 2,4);
$UserName = trim(user_session::get_user_name());
$userName_Check =$UserNmame_;


?>
