<?php
    if (!defined("UNSPECIFIED"))  define("UNSPECIFIED", "unspecified");
    if (!defined("FINALIZE"))  define("FINALIZE", "finalize");
    if (!defined("FILE_PATH"))  define("FILE_PATH", dirname(dirname(__FILE__)));
    if (!defined("NOT_EXPIRE")){
        include_once FILE_PATH."/check_user_expire.php";
    }
    
    include_once FILE_PATH."/class/util/strUtil.class.php";
    include_once FILE_PATH."/exception/fp_exception.php";

    $error_message = "";
    $action_name = strUtil::nvl($_REQUEST["action_name"], UNSPECIFIED);

    if (!strUtil::isEmpty($action_name)){
        if (function_exists($action_name)){
            call_user_func($action_name);
        } else if ($action_name != UNSPECIFIED) {
            fp_exception::display("Action Name ($action_name) is not exists.");
        }
    }
    
    if (strUtil::isNotEmpty($error_message)) {
         echo "<script>setTimeout('alert(\"$error_message\");', 150);</script>";
    }

    if (function_exists(FINALIZE)){
        call_user_func(FINALIZE);
    }
?>