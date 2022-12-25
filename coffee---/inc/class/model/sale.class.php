<?php
    include_once "model.class.php";
    include_once dirname(dirname(__FILE__))."/util/strUtil.class.php";
    include_once dirname(dirname(__FILE__))."/util/dateUtil.class.php";

    class sale extends model {

        public function exists($employee_code){
            $sql = "SELECT sale_id FROM tb_sale WHERE sale_status = 'A' AND employee_code = '$employee_code'";
            $result = $this->db->query($sql);
            $rows = $this->db->num_rows($result);

            if ($rows > 0){
                $row = $this->db->fetch_array($result);
                return $row["sale_id"];
            }

            return false;
        }
        
        public function getById($sale_id){
            $field = "s.sale_id, s.manager_id, vs1.sale_full_name AS manager_name"
                       . ", s.employee_code, s.sale_group_id, g.sale_group_name, s.title, s.sale_first_name, s.sale_last_name, s.user_login, s.pass"
                       . ", s.position_id, p.position_name, s.company_id, c.company_name, s.department"
                       . ", s.sale_status, s.address, s.amp_id, a.amp_name_th AS amp_name, s.prv_id, pv.prv_name_th AS prv_name, s.post_code, s.telephone"
                       . ", s.mobile, s.email, s.email_notify, s.daily_report, s.weekly_report"
                       . ", vs2.sale_full_name AS created_by, s.created_date"
                       . ", vs3.sale_full_name AS modified_by, s.modified_date";
            $table = " tb_sale s"
                        . " LEFT JOIN v_tb_sale vs1 ON (s.manager_id = vs1.sale_id)"
                        . " INNER JOIN tb_position p ON (s.position_id = p.position_id)"
                        . " LEFT JOIN tb_company c ON (s.company_id = c.company_id)"
                        . " LEFT JOIN tb_amphur a ON (s.amp_id = a.amp_id)"
                        . " LEFT JOIN tb_province pv ON (s.prv_id = pv.prv_id)"
                        . " LEFT JOIN tb_sale_group g ON (s.sale_group_id = g.sale_group_id)"
                        . " LEFT JOIN v_tb_sale vs2 ON (s.created_by = vs2.sale_id)"
                        . " LEFT JOIN v_tb_sale vs3 ON (s.modified_by = vs3.sale_id)";
            $condition = "s.sale_id = '$sale_id'";

            $result = $this->db->select($field, $table, $condition);
            $rows = $this->db->num_rows($result);

            if ($rows == 0) return null;

            $sale = $this->db->fetch_array($result);

            return $sale;
        }

        public function lst($criteria){
            $sql = " SELECT"
                    . "    vs.sale_id, vs.manager_id, vs.position_id, p.position_name, vs.company_id, vs.department"
                    . "    , vs.employee_code, vs.sale_full_name AS sale_name, vs.email, vs.email_notify, vs.daily_report, vs.weekly_report"
                    . " FROM v_tb_sale vs"
                    . " LEFT JOIN tb_position p ON (vs.position_id = p.position_id)"
                    . " WHERE vs.type = 'USR'";
            
            if (strUtil::isNotEmpty($criteria["sale_name"])){
                $sql .= " AND (vs.sale_first_name LIKE '%{$criteria["sale_name"]}%'";
                $sql .= " OR vs.sale_last_name LIKE '%{$criteria["sale_name"]}%')";
            }

            if (strUtil::isNotEmpty($criteria["employee_code"])){
                $sql .= " AND vs.employee_code LIKE '%{$criteria["employee_code"]}%'";
            }

            if (strUtil::isNotEmpty($criteria["manager_id"])){
                if ($criteria["manager_id"] == "NULL"){
                    $sql .= " AND vs.manager_id IS NULL";
                } else {
                    $sql .= " AND vs.manager_id = '{$criteria["manager_id"]}'";
                }
            }

            if (strUtil::isNotEmpty($criteria["position_id"])){
                $sql .= " AND vs.position_id = '{$criteria["position_id"]}'";
            }

            if (strUtil::isNotEmpty($criteria["sale_group_id"])){
                $sql .= " AND vs.sale_group_id = '{$criteria["sale_group_id"]}'";
            }

            if (strUtil::isNotEmpty($criteria["weekly_report"])){
                $sql .= " AND vs.weekly_report = '{$criteria["weekly_report"]}'";
            }

            $sql .= " ORDER BY vs.employee_code";

            $result = $this->db->query($sql);
            $rows = $this->db->num_rows($result);

            if ($rows == 0) return array();

             while($row = $this->db->fetch_array($result)){
                $arr_sale[] = $row;
            }

            return $arr_sale;
        }

        public function search($criteria, $page = 1){
            global $page_size;

            $field = " s.sale_id, s.employee_code, s.sale_first_name, s.sale_last_name, s.position_id, p.position_name, s.telephone, s.mobile"
                       . ", s2.sale_first_name AS manager_first_name, s2.sale_last_name AS manager_last_name, g.sale_group_name";
            $table = " tb_sale s"
                        . " INNER JOIN tb_position p ON (s.position_id = p.position_id)"
                        . " LEFT JOIN tb_sale s2 ON (s.manager_id = s2.sale_id)"
                        . " LEFT JOIN tb_sale_group g ON (s.sale_group_id = g.sale_group_id)";

            $condition = " s.sale_status IS NULL OR s.sale_status <> 'D' AND s.type='USR'";

            if (strUtil::isNotEmpty($criteria["sale_name"])){
                $condition .= " AND (s.sale_first_name LIKE '%{$criteria["sale_name"]}%'";
                $condition .= " OR s.sale_last_name LIKE '%{$criteria["sale_name"]}%')";
            }

            if (strUtil::isNotEmpty($criteria["employee_code"])){
                $condition .= " AND s.employee_code LIKE '%{$criteria["employee_code"]}%'";
            }

            if (strUtil::isNotEmpty($criteria["manager_id"])){
                $condition .= " AND s.manager_id = '{$criteria["manager_id"]}'";
            }

            if (strUtil::isNotEmpty($criteria["position_id"])){
                $condition .= " AND s.position_id = '{$criteria["position_id"]}'";
            }

            $condition .= " ORDER BY s.employee_code";


            $total_row = $this->db->count_rows($table, $condition);
            $result = $this->db->select_data_page($field, $table, $condition, $page, $page_size);
            $rows = $this->db->num_rows($result);

            if ($rows == 0) return array();

            while($row = $this->db->fetch_array($result)){
                $arr_sale[] = $row;
            }

            return array(
                "total_row" => $total_row
                , "arr_sale" => $arr_sale
            );
        }

        public function searchLookup($criteria) {
            $field = "s.sale_id, s.employee_code, s.sale_full_name, p.position_name";
            $table = " v_tb_sale s"
                       . " INNER JOIN tb_position p ON (s.position_id = p.position_id)";
            $condition = "s.sale_status = 'A' and s.type='USR'";
            $order_by= "s.employee_code";

            if (strUtil::isNotEmpty($criteria["employee_code"])) {
                $condition .= " AND employee_code LIKE '%{$criteria["employee_code"]}%'";
            }

            if (strUtil::isNotEmpty($criteria["employee_name"])) {
                $condition .= " AND (sale_first_name LIKE '%{$criteria["employee_name"]}%' OR sale_last_name LIKE '%{$criteria["employee_name"]}%')";
            }

            if (strUtil::isNotEmpty($criteria["position_id"])) {
                $condition .= " AND s.position_id = '{$criteria["position_id"]}'";
            }

            if (strUtil::isNotEmpty($criteria["sale_not_allow"])) {
                $condition .= " AND s.sale_id <> '{$criteria["sale_not_allow"]}'";
            }

            $result = $this->db->select($field, $table, $condition, $order_by);
            $rows = $this->db->num_rows($result);

            if ($rows == 0) return array();

            while ($row = $this->db->fetch_array($result)){
                $arr[] = $row;
            }

            return $arr;
        }

        public function isDuplicate($sale){
            $table = "tb_sale";

            # check duplicate employee_code
            $condition = "employee_code = '{$sale["employee_code"]}'";
            if (strUtil::isNotEmpty($sale["sale_id"])){
                $condition .= " AND sale_id <> '{$sale["sale_id"]}'";
            }

            $rows = $this->db->count_rows($table, $condition);

            if ($rows > 0){
                return "employee_code";
            }

            return false;
        }
        
        public function delete($sale_id){
            return $this->deleteWithUpdate("tb_sale", "sale_status", "D", "sale_id = '$sale_id'");
        }

        public function insert(&$sale){
            $table = "tb_sale";
            $field = "manager_id, position_id, company_id, department, employee_code, sale_group_id"
                      . ", title, sale_first_name, sale_last_name, sale_status"
                      . ", address, amp_id, prv_id, post_code, telephone, mobile, email"
                      . ", email_notify, daily_report, weekly_report"
                      . ", user_login, pass"
                      . ", created_by, created_date, modified_by, modified_date";
            $data = "{$sale["manager_id"]}, '{$sale["position_id"]}', {$sale["company_id"]}, '{$sale["department"]}', '{$sale["employee_code"]}', {$sale["sale_group_id"]}"
                       . ", '{$sale["title"]}', '{$sale["sale_first_name"]}', '{$sale["sale_last_name"]}', '{$sale["sale_status"]}'"
                       . ", '{$sale["address"]}', {$sale["amp_id"]}, {$sale["prv_id"]}, '{$sale["post_code"]}', '{$sale["telephone"]}', '{$sale["mobile"]}', '{$sale["email"]}'"
                       . ", '{$sale["email_notify"]}', '{$sale["daily_report"]}', '{$sale["weekly_report"]}'"
                       . ", '{$sale["user_login"]}', '{$sale["pass"]}'"
                       . ", '{$sale["action_by"]}', '{$sale["action_date"]}', '{$sale["action_by"]}', '{$sale["action_date"]}'";

            $result = $this->db->insert($table, $field, $data);

            if ($result){
                $sale["sale_id"] = $this->db->insert_id();
            }

            return $result;
        }

        public function update($sale){
            $table = "tb_sale";
            $data = "manager_id = {$sale["manager_id"]}"
                       . ", position_id = '{$sale["position_id"]}'"
                       . ", company_id = {$sale["company_id"]}"
                       . ", department = '{$sale["department"]}'"
                       . ", employee_code = '{$sale["employee_code"]}'"
                       . ", sale_group_id = {$sale["sale_group_id"]}"
                       . ", title = '{$sale["title"]}'"
                       . ", sale_first_name = '{$sale["sale_first_name"]}'"
                       . ", sale_last_name = '{$sale["sale_last_name"]}'"
                       . ", sale_status = '{$sale["sale_status"]}'"
                       . ", address = '{$sale["address"]}'"
                       . ", amp_id = {$sale["amp_id"]}"
                       . ", prv_id = {$sale["prv_id"]}"
                       . ", post_code = '{$sale["post_code"]}'"
                       . ", telephone = '{$sale["telephone"]}'"
                       . ", mobile = '{$sale["mobile"]}'"
                       . ", email = '{$sale["email"]}'"
                       . ", email_notify = '{$sale["email_notify"]}'"
                       . ", daily_report = '{$sale["daily_report"]}'"
                       . ", weekly_report = '{$sale["weekly_report"]}'"
                       . ", user_login = '{$sale["user_login"]}'"
                       . ", pass = '{$sale["pass"]}'"
                       . ", modified_by = '{$sale["action_by"]}'"
                       . ", modified_date = '{$sale["action_date"]}'";
            $condition = "sale_id = '{$sale["sale_id"]}'";

            return $this->db->update($table, $data, $condition);
        }
    }    
?>