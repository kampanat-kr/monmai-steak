<?php
 "<meta charset='utf-8'>";
    require_once "class/util/urlUtil.class.php";
    // require_once "label/th.php";
    define("SERVER_PROD", 0);

    // $web_url = (SERVER_PROD == "1") ? "http://e-app.samartcorp.com" : "login.php";
	# doc Part
	// echo $doc_path = urlUtil::getDocRoot();


    # System Path
    $application_path = urlUtil::getWebDir(dirname(dirname((__FILE__))));
    $application_script = "script_php/";
    $application_path_images = "$application_script/images";
    $application_path_include = "$application_script/include";
    $application_path_js = "$application_path/js";
    $application_path_css = "$application_path/css";

    # API URL
    # Data Base

    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_password = "";
    $db_schemata = "db_monmai";

    //$db_host = "164.115.23.70";
    //$db_user = "twdf";
    //$db_password = "cDD@**!!";
    //$db_schemata = "mapcoverage";

    //$db_host = "164.115.23.71";
    //$db_user = "twdf";
    //$db_password = "cDD@**!!";
    //$db_schemata = "thaiqm";

?>
