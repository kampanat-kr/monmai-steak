<?php
    include_once "model.class.php";
    include_once dirname(dirname(__FILE__))."/encryption.class.php";
    include_once dirname(dirname(__FILE__))."/util/dateUtil.class.php";
    include_once dirname(dirname(__FILE__))."/util/strUtil.class.php";

    class security extends model {

        public function login($employee_code = "", $username = "", $password = ""){
            global $application_version;
            
            $ipaddress = $_SERVER["REMOTE_ADDR"];
            $computer_name = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
            $user_agent = $_SERVER["HTTP_USER_AGENT"];
            $current_date = dateUtil::current_date_time();
            $sale_id = "NULL";

            # check browse
            if ($this->isBrowserAllow($user_agent) == false){
                $error_type = "B";
            } else {
                # login
                $sql = " SELECT sale_id, employee_code, sale_first_name, sale_last_name, user_login, pass, sale_group_id, sale_status"
                         . " FROM tb_sale"
                         . " WHERE 1 = 1";

                if (strUtil::isNotEmpty($employee_code)) {
                    $sql .= " AND employee_code = '$employee_code'";
                }

                if (strUtil::isNotEmpty($username)) {
                    $sql .= " AND user_login = '$username'";
                }

                $result = $this->db->query($sql);
                $rows = $this->db->num_rows($result);

                # verify
                if($rows == 0){
                    # employee_code not found
                    $error_type = "F";

                } else {
                    $row = $this->db->fetch_array($result);
                    $sale_id = $row["sale_id"];

                    if ($row["sale_status"]  != "A"){
                        # sale is not active
                        $error_type = "A";

                    } else if (strUtil::isNotEmpty($password)){
                        # check password
                        $employee_code = $username;
                        $password = encryption::has_password($username, $password);
                        if ($row["pass"] != $password){
                            $error_type = "P";
                        } else {
                            # check version
                            //$sql = "SELECT value FROM tb_config WHERE con_code = 'C001'";
                            // $error_type = "V";
                        }
                    }
                }
            }

            #delete log at > 90 days(3 months)
            $date = date("YmdHis", strtotime("$current_date -90 day"));
            $sql = "DELETE FROM tb_login_log WHERE login_date < '$date'";
            $result = $this->db->query($sql);

            # insert log
            $sql = " INSERT INTO tb_login_log("
                    . " sale_id, login_date, logout_date, employee_code, user_login, ip_address, computer_name, user_agent"
                    . " , error_type, time_stamp, active_page, version"
                    . " ) VALUES ("
                    . " $sale_id, '$current_date', NULL, '$employee_code', '$username', '$ipaddress', '$computer_name'"
                    . " , '$user_agent', '$error_type', '$current_date', NULL, '$application_version'"
                    . " )";

            $result = $this->db->query($sql);
            $log_id = $this->db->insert_id();

            return array(
                "log_id" => $log_id
                , "sale_id" => $row["sale_id"]
                , "employee_code" => $row["employee_code"]
                , "sale_name" => $row["sale_first_name"]." ".$row["sale_last_name"]
                , "user_login" => $row["user_login"]
                , "sale_group_id" => $row["sale_group_id"]
                , "error_type" => $error_type
            );
        }

        public function logout($log_id){
            $sql = " UPDATE tb_login_log SET"
                    . " logout_date = '". dateUtil::current_date_time()."'"
                    . " WHERE log_id = '$log_id'";
            return $this->db->query($sql);
        }

        public function updateLog($log_id){
            $sql = " UPDATE tb_login_log SET"
                     . " time_stamp = '".dateUtil::current_date_time()."'"
                     . " , active_page = '{$_SERVER["REQUEST_URI"]}'"
                     . " WHERE log_id = '$log_id'";
            return $this->db->query($sql);
        }

        public function getSessionInfo($log_id){
            $sql = "SELECT time_stamp, version FROM tb_login_log WHERE logout_date Is NULL AND log_id = '$log_id'";
            $result = $this->db->query($sql);
            $rows = $this->db->num_rows($result);

            if ($rows == 0) return null;
            
            $row = $this->db->fetch_array($result);
            $current_date = dateUtil::current_date_time();
            $time_stamp = $row["time_stamp"];

            $info["idle_time"] = dateUtil::dateDiff($current_date, $time_stamp, dateUtil::DIFF_IN_MINUTES);
            $info["version"] =$row["version"];

            return $info;
        }

        public function isBrowserAllow($user_agent){
            $arr_allow = array("MSIE", "Firefox", "Safari", "Chrome", "Opera");
            foreach ($arr_allow as $browser) {
                if ((int)strpos(" ".$user_agent, $browser) > 0){
                    return true;
                }
            }

            return false;
        }
    }
?>