<?php
    include_once dirname(__FILE__)."/util/arrUtil.class.php";

    class dropdown {

         public static function select($name, $option, $attr = ""){
            $dd = "<select id=\"$name\" name=\"$name\" $attr>\n";
            $dd .= "   ".$option."\n";
            $dd .= "</select>\n";

            return $dd;
        }

        public static function bindDropdown($data, $name, $allowBlank = true, $valueMember = "id", $displayMember = "text", $attr = "", $selectValue = ""){
            if ($allowBlank){
                arrUtil::insert($data, array(), 0);
            }

            if (count($data) > 0){                
                foreach ($data as $d) {
                    $option .= "   <option value=\"{$d[$valueMember]}\" ".(($selectValue == $d[$valueMember]) ? "selected" : "").">{$d[$displayMember]}</option>\n";
                }

                return self::select($name, $option, $attr);
            }

            return "";
        }

        public static function bindDropdownByGroup($data, $name, $allowBlank = true, $optGroup = "optGroup", $valueMember = "id", $displayMember = "text", $attr = "", $selectValue = ""){
            if ($allowBlank){
                $option = "   <option></option>\n";
            }

            $og = "";

            if (count($data) > 0){
                foreach ($data as $d) {
                    $oglabel = $d[$optGroup];

                    if ($og != $oglabel){
                        if (strUtil::isNotEmpty($og)){
                            $option .= "   </optgroup>\n";
                        }
                        $og = $oglabel;
                        $option .= "   <optgroup label=\"$og\">\n";
                    }

                    $option .= "      <option value=\"{$d[$valueMember]}\" ".(($selectValue == $d[$valueMember]) ? "selected" : "").">{$d[$displayMember]}</option>\n";
                }
                $option .= "   </optgroup>\n";
            }

            return self::select($name, $option, $attr);
        }

        public static function loadCountry($db, $name, $attr = "", $select = "", $con_id = ""){
            $country = new country($db);
            $country = $country->listCombo($con_id);

            return self::bindDropdownByGroup($country, $name, true, "con_name", "cou_id", "cou_name", $attr, $select);
        }

        public static function loadProvince($db, $name, $attr = "", $select = "", $reg_id = ""){
            $province = new province($db);
            $province = $province->listCombo($reg_id);

            return self::bindDropdownByGroup($province, $name, true, "reg_name", "prv_id", "prv_name", $attr, $select);
        }

        public static function loadAmphur($db, $name, $attr = "", $select = "", $prv_id = ""){
            $amphur = new Amphur($db);
            $amphur = $amphur->listCombo($prv_id);

            return self::bindDropdown($amphur, $name, true, "amp_id", "amp_name", $attr, $select);
        }

        public static function loadSaleGroup($db, $name, $attr = "", $select = ""){
            $sale_group = new sale_group($db);
            $sale_group = $sale_group->listCombo();

            return self::bindDropdown($sale_group, $name, true, "sale_group_id", "sale_group_name", $attr, $select);
        }

        public static function loadCustomerGroup($db, $name, $attr = "", $select = ""){
            $customer_group = new customer_group($db);
            $customer_group = $customer_group->listCombo();

            return self::bindDropdown($customer_group, $name, true, "customer_group_id", "customer_group_name", $attr, $select);
        }

        public static function loadObjective($db, $name, $attr = "", $select = ""){
            $objective = new objective($db);
            $objective = $objective->listCombo();

            return self::bindDropdown($objective, $name, true, "objective_id", "objective_name", $attr, $select);
        }

        public static function loadNextStep($db, $name, $attr = "", $select = ""){
            $nextstep = new nextstep($db);
            $nextstep = $nextstep->listCombo();

            return self::bindDropdown($nextstep, $name, true, "next_step_id", "next_step_name", $attr, $select);
        }

        public static function loadPosition($db, $name, $attr = "", $select = ""){
            $position = new position($db);
            $position = $position->listCombo();

            return self::bindDropdown($position, $name, true, "position_id", "position_name", $attr, $select);
        }

        public static function loadMenu($db, $name, $attr = "", $select = ""){
            $menu = new menu($db);
            $menu = $menu->listCombo();

            return self::bindDropdown($menu, $name, true, "menu_id", "menu_name", $attr, $select);
        }

        public static function loadLob($db, $name, $attr = "", $select = ""){
            $lob = new lob($db);
            $lob = $lob->listCombo();

            return self::bindDropdown($lob, $name, true, "lob_id", "lob_name", $attr, $select);
        }

        public static function loadTitle($name, $attr = "", $select = ""){
            $title = array(
                array("id" => "Mr", "text" => "Mr")
                , array("id" => "Mrs", "text" => "Mrs")
                , array("id" => "Ms", "text" => "Ms")
            );

            return self::bindDropdown($title, $name, true, "id", "text", $attr, $select);
        }


        public static function loadProjectSize($name, $attr = "", $select = ""){
            $title = array(
                array("id" => "S", "text" => "S")
                , array("id" => "M", "text" => "M")
                , array("id" => "L", "text" => "L")
            );

            return self::bindDropdown($title, $name, true, "id", "text", $attr, $select);
        }

    }
?>
