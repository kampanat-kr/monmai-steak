<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include_once dirname(dirname(dirname(__FILE__)))."/config.inc.php";
    include_once dirname(dirname(dirname(__FILE__)))."/handler/error_handler.php";
    include_once dirname(__FILE__)."/mysql.class.php";

    $db = new db();
    if(!$con)
    {
        $con = $db->connect($db_host, $db_user, $db_password);
        $db->select_db($db_schemata, $con);
        mysql_query("SET NAMES UTF8");
    }

?>
