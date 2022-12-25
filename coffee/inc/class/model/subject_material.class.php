<?php
    include_once "model.class.php";

    class subject_material extends model {
        function search($criteria, $page = 1){
            global $page_size;            
            $field = " material_code, material_name";
            $table = " tb_material";
            $condition = " status <> 'D'"
                              . " ORDER BY material_code";
            $total_row = $this->db->count_rows($table, $condition);
            $result = $this->db->select_data_page($field, $table, $condition, $page, $page_size);
            $rows = $this->db->num_rows($result);
            if ($rows == 0) return array();
            while($row = $this->db->fetch_array($result)){
                $arr[] = $row;				
            }
            return array(
                "total_row" => $total_row
                , "arr_subject_material" => $arr
            );
        }

        public function getById($subject_id){
            $field = "g.subject_id, g.material_id, g.qty, g.status, s1.material_name"
                      . ", s2.user_name AS created_by, g.created_date, s3.user_name AS modified_by, g.modified_date";
            $table = " tb_subject_material g"			                        . " LEFT JOIN tb_material s1 ON (g.material_id = s1.id)"						
                        . " LEFT JOIN tb_user s2 ON (g.created_by = s2.user_id)"
                        . " LEFT JOIN tb_user s3 ON (g.modified_by = s3.user_id)";
            $condition = "g.subject_id = '$subject_id'";
            $result = $this->db->select($field, $table, $condition);
            $rows = $this->db->num_rows($result);
            if ($rows == 0) return array();
            $subject_material = $this->db->fetch_array($result);
            $subject_material["material"] = $this->getSubject_Material($subject_id);
            return $material_id;
        }

        public function getSubject_Material($subject_id){
            $field = "gs.material_code AS material_code, gs.material_name AS material_name";
            $table = " tb_subject_material gs";
            $condition = "gs.status = 'A' AND gs.subject_id = '$subject_id'";
            $order_by = "gs.subject_id";
            $result = $this->db->select($field, $table, $condition, $order_by);
            $rows = $this->db->num_rows($result);
            if ($rows == 0) return array();
            while ($row = $this->db->fetch_array($result)) {
                $material[] = $row;
            }
            return $material;
        }
        public function searchMaterial($criteria){
            $field = "s.id, s.material_code, s.material_name";
            $table = "tb_material s";
            $condition = "s.status = 'A'";
            $order_by= "s.material_code";            $result = $this->db->select($field, $table, $condition, $order_by);
            $rows =  $this->db->num_rows($result);
            if ($rows == 0) return array();
            while ($row = $this->db->fetch_array($result)){
                $arr_material[] = $row;
            }
            return $arr_material;
        }
        public function isDuplicate($subject_material){
            $table = "tb_subject_material";
            # check duplicate subject_material_code            $condition = "subject_id = '{$subject_material["subject_id"]}' AND  material_id = '{$subject_material["material_id"]}' AND status <> 'D'";
            if (strUtil::isNotEmpty($subject_material["subject_id"])){
                $condition .= " AND subject_id <> '{$subject_material["subject_id"]}'";
            }			            if (strUtil::isNotEmpty($subject_material["material_id"])){                $condition .= " AND material_id <> '{$subject_material["material_id"]}'";            }
            $rows = $this->db->count_rows($table, $condition);
            if ($rows > 0){
                return "material_code";
            }
        }

        public function delete($subject_id, $material_id){
            return $this->deleteWithUpdate("tb_subject_material", "status", "D", "subject_id = '$subject_id' and material_id = '$material_id'");
        }

        public function insert(&$subject_material){
            $table = "tb_subject_material";
            $field = "subject_id, material_id, qty, unit_id, status"
                      . ", created_by, created_date, modified_by, modified_date";
            $data = "'{$subject_material["subject_id"]}', '{$subject_material["material_id"]}', '{$subject_material["qty"]}', '{$subject_material["unit_id"]}', '{$subject_material["status"]}'"
                       . ", '{$subject_material["action_by"]}', '{$subject_material["action_date"]}', '{$subject_material["action_by"]}', '{$subject_material["action_date"]}'";

            $result = $this->db->insert($table, $field, $data);
             return $result;
        }

        public function update($subject_material){
            $table = "tb_subject_material";
            $data = "subject_id = '{$subject_material["subject_id"]}'"
                        . ", material_id = '{$subject_material["material_id"]}'"
						. ", qty = '{$subject_material["qty"]}'"												. ", unit_id = '{$subject_material["unit_id"]}'"						
                        . ", status = '{$subject_material["status"]}'"
                        . ", modified_by = '{$subject_material["action_by"]}'"
                        . ", modified_date = '{$subject_material["action_date"]}'";
            $condition = "subject_id = '{$subject_material["subject_id"]}' and material_id = '{$subject_material["material_id"]}'";

            $result = $this->db->update($table, $data, $condition);            return $result;
        }
        public function insertMaterial($subject_id, $material_id, $material){
            $table = "tb_subject_material";
            $field = "subject_id, material_id";
            foreach ($material as $m) {
                $m = trim($m);
                if (strUtil::isEmpty($m)) continue;
                $data = "'$subject_id, $material_id', '$m'";
                $result = $this->db->insert($table, $field, $data);
                if(!$result) return false;
            }
            return true;
        }
    }
?>
