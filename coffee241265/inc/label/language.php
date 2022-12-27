<?
	session_start();
	include_once dirname(dirname(__FILE__))."/class/user_session.class.php";
	$language = user_session::get_language();
	require_once dirname(__FILE__)."/$language.php";
?>