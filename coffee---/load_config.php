<?php
error_reporting (E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Bangkok');
session_start();
ini_set('max_execution_time',3600);
include_once "inc/config.inc.php";
include_once "inc/class/user_session.class.php";
include_once "inc/class/db/db.php";
include_once "inc/function.php";
include_once "inc/class/util/strUtil.class.php";
include_once "inc/class/util/dateUtil.class.php";
include_once "inc/class/security.class.php";

# server

    date_default_timezone_set('Asia/Bangkok');
    $action_date = date("Y-m-d H:i:s");
    $login_time = date("H:i:s");
    $ip_address = $_SERVER["REMOTE_ADDR"];
    $computer_name = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    //$current_date = dateUtil::current_date_time();

    # request
    $username = $_REQUEST["Username"];
    $password = $_REQUEST["Password"];
	  $getScrime = $password;
    # private valiable
    $error_type = "";
    $message = "";
    $url = "index.php";
    $log_message = "Successful";
    $sale_id = "NULL";
    $Province = '12';

    # validate
    //if (isBrowserAllow($user_agent) == false){
    //    $error_type = "B";
    //    $message = "<b>System Recommended :</b> Internet Explorer, Firefox , Safari, Chrome and Opera. Please contact Helpline";
    //    $url = "login.php";
    //} else {
        if ((strUtil::isEmpty($username))||(strUtil::isEmpty($password))){
            $message = "ข้อมูลไม่ถูกต้อง";
            $url = "index.php";
            $log_message = "isEmpty";
        } else {
            # login
            $field = "*";
            $table = "sys_member";
            $condition = "1 = 1";
            if (strUtil::isNotEmpty($username)) $condition .= " AND username = '$username'";

            $result = $db->select($field, $table, $condition);
            $rows = $db->num_rows($result);
            $row = $db->fetch_array($result);
            $officename = $row["officename"];
            $hoscode_login = $row["officename"];
            $groupwork_id = $row["groupwork"];
            $hostype =  $row["hostype"];
            $CID = $row["cid"];
            $cidmd5 =  md5($row["cid"]);

            # user is not active
            if ($row["status"]  != "yes"){
                $error_type = "0";
                $message = "User ยังไม่ได้รับอนุมัติสิทธ์ในการเข้าใช้งาน !!!";
                $action_process = $message;
                $log_message = "unSuccess";
                $url = "../index.php";
                
            } else if (strUtil::isNotEmpty($password)){
                $employee_code = $username;
                //$password = security::has_password($username, $password);

                $password = md5($password);
                //echo $url;
                if ($row["password"] != $password){
                    $error_type = "0";
                    $message = "User หรือ Password ไม่ถูกต้อง !!!  "."<br>".$password;
                    $action_process = $message;
                    $log_message = "unSuccess";
                    $url = "../index.php";

                }

            }

		}
            /*
              $result_group2 = $db->select("*" , "0online_log","user_name ='$username'");
              $num_group2 = $db->num_rows($result_group2);
              if($num_group2 != 0){
                $message = "User Onlineในระบบอยู่ ไม่สามารถออนไลน์พร้อมกันสองเครื่องได้ !!!  "."<br>". " ติดต่อหัวหน้างานกลุ่มงาน ตรวจสอบการใช้งาน";
                $log_message = "unSuccess";
                $url = "index_mail.php";
              }
              */




    //}

    # user account infomation
    //user_session::set_org_name($ORG_NAME);
    user_session::set_log_id($log_id);
    //user_session::set_div_id($row["DivId"]);
    //user_session::set_user_id($row["UserId"]);
    user_session::set_user_name($row["id"]);
    user_session::set_user_login($row["username"]);
    user_session::set_dealer_code($row["off_name"]);
    user_session::set_access_group($row["RoleId"]);
    user_session::set_language('th');
		//user_session::set_scrime($getScrime); //---------- Create By Deaw TSD 24-09-59

    user_session::set_hoscode($row["officename"]);
    user_session::set_cid($row["cid"]);



	$login_date = date("Y-m-d");
	//$login_time = date("m:h:s");
	$log_table = "log_admin_login";
	//----------Stamp Logout-----------
	//$logout_data = "logout_date='$login_date',logout_time='$login_time'";
	//$condition_logout = "merchant_code ='{$row["merchant_code"]}' and log_message=''";
	//$db->update($log_table, $logout_data, $condition_logout);
	//---------------------------------

	//----------Stamp Login------------

	//---------------------------------
      //--------------------------------- Deaw Create
          if (!empty($row["id"])) {
                  //if ($num_group2 == 0) {
                        $result_start_login = $db->query("SELECT NOW( ) AS start_login"); //---------- get now Date and Time by Server
                        $date_start_login = $db->fetch_array($result_start_login);
                        $online_field = "user_id,user_name,last_update,ip_address,hoscode,hostype,groupwork";
                        $online_data = " '{$row["id"]}','$username','{$date_start_login["start_login"]}','$ip_address','$officename','$hostype','$groupwork_id' ";
                        $db->insert("online_log", $online_field, $online_data);
                        $login_id = mysql_insert_id();
                        user_session::set_log_id($login_id);
                        //----------Get id Login LOG------------
                        $result_logID = $db->select("login_id","online_log", "user_id='{$row["id"]}' AND user_name='$username' AND last_update='{$date_start_login["start_login"]}' ");
                        $row_logID = $db->fetch_array($result_logID);

                        $action_process = "login เข้าสู่ระบบ";

                        $log_field = "username,ip_address,computer_name,online_log_login_id,login_date,login_time,log_message,cid,groupwork,hoscode";
                        $log_data = "'$username','$ip_address','$computer_name','$login_id','$login_date','$login_time','$log_message','$CID','$groupwork_id','$hoscode_login'";
                        $db->insert($log_table, $log_field, $log_data);

                        //include_once "mod/action.php";
                    }
    //---------------------------------
    $db->close();
    function isBrowserAllow($user_agent){
        $arr_allow = array("MSIE", "Firefox", "Safari", "Chrome", "Opera");
        foreach ($arr_allow as $browser) {
            if ((int)strpos(" ".$user_agent, $browser) > 0){
                return true;
            }
        }

        return false;
    }
?>
<!doctype html>
<head>
<script langquage='javascript'>
 <?php if ($url !="index.php"){ ?> alert ('<?=$message?>'); <?php } ?>
          window.location.href="<?=$url?>";
</script>
</body>
</html>
