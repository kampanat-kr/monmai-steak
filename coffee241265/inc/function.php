<?php

  function provinces_name($DivCode) {
  global $db;
  $field = "name";
  $table = "provinces";
  $condition = "id='$DivCode'";
  $result = $db->select($field, $table, $condition);
  $data = $db->fetch_array($result);
  if (count($data)==0) {
  return "-";
  } else {
  return $data["name"];
  }
  }

function cal_persent($value1,$value2) {
   if ($value1 > 0) {
       $persent = ($value1 *100) / $value2;
   }else {
       $persent = 0;
   }
    return $persent;
}

function monthend($month) {
    // $YYc = $YY;
    switch ($month) {
        case "10": $dateend_chk=31;
            break;
        case "11": $dateend_chk=30;
            break;
        case "12": $dateend_chk=31;
            break;
        case "01": $dateend_chk=31;
            break;
        case "02": $dateend_chk=28;
            break;
        case "03": $dateend_chk=31;
            break;
        case "04": $dateend_chk=30;
            break;
        case "05": $dateend_chk=31;
            break;
        case "06": $dateend_chk=30;
            break;
        case "07": $dateend_chk=31;
            break;
        case "08": $dateend_chk=31;
            break;
        case "09": $dateend_chk=30;
            break;
    }
    return $dateend_chk;
}

function color_data($score) {
    global $db;
    if ($score == 0) {
        $color1 = "#CCC";
    } else if ($score <= 2) {
        $color1 = "#FF0000";
    } else if ($score <= 3) {
        $color1 = "#FF9900";
    } else if ($score <= 4) {
        $color1 = "#FFFF00";
    } else if ($score < 5) {
        $color1 = "#99FF00";
    } else if ($score = 5) {
        $color1 = "#009900";
    }
    return ($color1);
}

function color_bg($score) {
    global $db;
    if ($score == 0) {
        $color1 = "bg-warning";
    } else if ($score <= 2) {
        $color1 = "bg-red";
    } else if ($score <= 3) {
        $color1 = "bg-danger";
    } else if ($score <= 4) {
        $color1 = "bg-yellow";
    } else if ($score < 5) {
        $color1 = "bg-green";
    } else if ($score = 5) {
        $color1 = "bg-terques";
    }
    return ($color1);
}

function selected($value, $value_selected, $default_value = "") {

    if ($value == $value_selected) {

        return "selected";
    } else if ($default_value != "" && $default_value == $value) {

        return "selected";
    }



    return "";
}

function checked($value, $value_checked, $default_value = "") {

    if ($value == $value_checked) {

        return "checked";
    } else if ($default_value != "" && $default_value == $value) {

        return "checked";
    }



    return "";
}

function message($type, $message, $btn_name, $link, $btn_name1 = "", $link1 = "") {

    $txt_icon = "/1sky/images/" . strtolower($type) . ".png";

    $title = strtoupper($type);



    $msg = "<div align='center'>";

    $msg .= "  <div class='$type' align='left'>";

    $msg .= "        <h1><img src=$txt_icon alt='$title'/>&nbsp;$title</h1>";

    $msg .= "        <div class='notice'>$message</div>";

    $msg .= "        <div align='center'>";

    $msg .= "            <input type='button' name='btn_button' class='input-button' value='$btn_name' onclick='$link'>";

    if (($btn_name1) != "") {

        $msg .= "            <input type='button' name='btn_button' class='input-button' value='$btn_name1' onclick='$link1'>";
    }

    $msg .= "        </div>";

    $msg .= "    </div>";

    $msg .= "</div>";



    return $msg;
}

function num_to_words_thai($number) {

    $txtnum1 = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
    $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    $number = str_replace(",", "", $number);
    $number = str_replace(" ", "", $number);
    $number = str_replace("บาท", "", $number);
    $number = explode(".", $number);
    if (sizeof($number) > 2) {
        return 'ทศนิยมหลายตัวนะจ๊ะ';
        exit;
    }
    $strlen = strlen($number[0]);
    $convert = '';
    for ($i = 0; $i < $strlen; $i++) {
        $n = substr($number[0], $i, 1);
        if ($n != 0) {
            if ($i == ($strlen - 1) AND $n == 1) {
                $convert .= 'เอ็ด';
            } elseif ($i == ($strlen - 2) AND $n == 2) {
                $convert .= 'ยี่';
            } elseif ($i == ($strlen - 2) AND $n == 1) {
                $convert .= '';
            } else {
                $convert .= $txtnum1[$n];
            }
            $convert .= $txtnum2[$strlen - $i - 1];
        }
    }

    $convert .= 'บาท';
    if ($number[1] == '0' OR $number[1] == '00' OR
            $number[1] == '') {
        $convert .= 'ถ้วน';
    } else {
        $strlen = strlen($number[1]);
        for ($i = 0; $i < $strlen; $i++) {
            $n = substr($number[1], $i, 1);
            if ($n != 0) {
                if ($i == ($strlen - 1) AND $n == 1) {
                    $convert
                            .= 'เอ็ด';
                } elseif ($i == ($strlen - 2) AND
                        $n == 2) {
                    $convert .= 'ยี่';
                } elseif ($i == ($strlen - 2) AND
                        $n == 1) {
                    $convert .= '';
                } else {
                    $convert .= $txtnum1[$n];
                }
                $convert .= $txtnum2[$strlen - $i - 1];
            }
        }
        $convert .= 'สตางค์';
    }
    return $convert;
}

function date_in($date) {
    $d = substr($date, 0, 2);
    $m = substr($date, 3, 2);
    $y = substr($date, 6, 4);

    $datein = $y . "-" . $m . "-" . $d;
    return $datein;
}

function date_out($date) {
    $d = substr($date, 9, 2);
    $m = substr($date, 6, 2);
    $y = substr($date, 0, 4);

    $dateout = $d . "-" . $m . "-" . $y;
    return $dateout;
}

function thaiDate($datetime) {
    list($date, $time) = explode(' ', $datetime); // แยกวันที่ กับ เวลาออกจากกัน
    list($H, $i, $s) = explode(':', $time); // แยกเวลา ออกเป็น ชั่วโมง นาที วินาที
    list($Y, $m, $d) = explode('-', $date); // แยกวันเป็น ปี เดือน วัน
    $Y = $Y + 543; // เปลี่ยน ค.ศ. เป็น พ.ศ.

    switch ($m) {
        case "01": $m = "ม.ค.";
            break;
        case "02": $m = "ก.พ.";
            break;
        case "03": $m = "มี.ค.";
            break;
        case "04": $m = "เม.ย.";
            break;
        case "05": $m = "พ.ค.";
            break;
        case "06": $m = "มิ.ย.";
            break;
        case "07": $m = "ก.ค.";
            break;
        case "08": $m = "ส.ค.";
            break;
        case "09": $m = "ก.ย.";
            break;
        case "10": $m = "ต.ค.";
            break;
        case "11": $m = "พ.ย.";
            break;
        case "12": $m = "ธ.ค.";
            break;
    }
    return $d . " " . $m . " " . $Y;
}

function thaimonth($month, $YY) {
    // $YYc = $YY;
    switch ($month) {
        case "1": $m = "ม.ค./$YY";
            break;
        case "2": $m = "ก.พ./$YY";
            break;
        case "3": $m = "มี.ค./$YY";
            break;
        case "4": $m = "เม.ย./$YY";
            break;
        case "5": $m = "พ.ค./$YY";
            break;
        case "6": $m = "มิ.ย./$YY";
            break;
        case "7": $m = "ก.ค./$YY";
            break;
        case "8": $m = "ส.ค./$YY";
            break;
        case "9": $m = "ก.ย./$YY";
            break;
        case "10": $m = "ต.ค./$YY";
            break;
        case "11": $m = "พ.ย./$YY";
            break;
        case "12": $m = "ธ.ค./$YY";
            break;
    }
    return $m;
}

function showtype($type) {
    if ($type == 1) {
        return "อุดหนุน";
    } else if ($type == 2) {
        return "ระยะสั้น";
    } else if ($type == 3) {
        return "ระยะยาว";
    }
}

function gen_auto_code($DivIds, $ProjYears) {
    global $db;
    $year_c = date(Y);
    $field = "ProjCode";
    $table = "$DivIds" . "_projectsupport";
    $condition = "DivId='$DivIds' AND ProjYear='$ProjYears' ORDER BY ProjectId DESC limit 1";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return "1" . $DivIds . $ProjYears . "1";
    } else {
        return "1" . $DivIds . $ProjYears . (substr($data["ProjCode"], 7) + 1);
    }
}

function gen_auto_codeD($DivIds, $ProjYears) {
    global $db;
    $year_c = date(Y);
    $field = "ProjCode";
    $table = "$DivIds" . "_projectdebtor";
    $condition = "DivId='$DivIds' AND ProjYear='$ProjYears' ORDER BY ProjectId DESC limit 1";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return "2" . $DivIds . $ProjYears . "1";
    } else {
        return "2" . $DivIds . $ProjYears . (substr($data["ProjCode"], 7) + 1);
    }
}

function gen_auto_concode($DivIds, $ProjYears) {
    global $db;
    $year_c = date(Y);
    $field = "ConCode";
    $table = "$DivIds" . "_contact";
    $condition = "DivId='$DivIds' AND ConYear='$ProjYears' ORDER BY ConId DESC limit 1";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return "22" . $DivIds . $ProjYears . "1";
    } else {
        return "22" . $DivIds . $ProjYears . (substr($data["ConCode"], 8) + 1);
    }
}

function gen_auto_concode_sub($DivIds, $ProjYears) {
    global $db;
    $year_c = date(Y);
    $field = "ConCode";
    $table = "$DivIds" . "_contactsupport";
    $condition = "DivId='$DivIds' AND ConYear='$ProjYears' ORDER BY ConId DESC limit 1";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return "11" . $DivIds . $ProjYears . "1";
    } else {
        return "11" . $DivIds . $ProjYears . (substr($data["ConCode"], 8) + 1);
    }
}

function gen_auto_Draft_D($DivIds, $TimeId) {
    global $db;
    $year_c = date(Y);
    $field = "ProjCode";
    $table = "$DivIds" . "_projectdebtor";
    $condition = "TimeId='$TimeId' ORDER BY ProjectId DESC limit 1";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return 1;
    } else {
        return $data["ProjCode"] + 1;
    }
}

function tumbon_name($TumId) {
    global $db;
    $year_c = date(Y);
    $field = "DISTRICT_NAME";
    $table = " district";
    $condition = "DISTRICT_CODE='$TumId'";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return "-";
    } else {
        return $data["DISTRICT_NAME"];
    }
}

function amp_name($AmeId) {
    global $db;
    $year_c = date(Y);
    $field = "AMPHUR_NAME";
    $table = " amphur";
    $condition = "AMPHUR_CODE='$AmeId'";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return "-";
    } else {
        return $data["AMPHUR_NAME"];
    }
}

function cdisease($NCAUSE) {
    global $db;
    $year_c = date(Y);
    $field = "diseasethai";
    $table = "cdisease";
    $condition = "diagcode='$NCAUSE'";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return "-";
    } else {
        return $data["diseasethai"];
    }
}

/*
  function Projname($ProjCode) {
  global $db;
  $year_c = date(Y);
  $field = "ProjName";
  $table = "$projectdebtor";
  $condition = "ProjCode='$ProjCode'";
  $result = $db->select($field, $table, $condition);
  $data = $db->fetch_array($result);
  if (count($data)==0) {
  return "-";
  } else {
  return $data["ProjName"];
  }
  }

 */


function YearBudget($yy, $mm) {
    $year_c = $yy + 543;
    if (($mm == 10) || ($mm == 11) || ($mm == 12)) {
        $year_c = $year_c + 1;
    }
    return "$year_c";
}

function gen_auto_code_model($DivIds, $ProjYears) {
    global $db;
    $year_c = date(Y);
    $field = "ProjCode";
    $table = " projectdebtor_model";
    $condition = "DivId='$DivIds' AND ProjYear='$ProjYears' ORDER BY ProjectId DESC limit 1";
    $result = $db->select($field, $table, $condition);
    $data = $db->fetch_array($result);
    if (count($data) == 0) {
        return "2" . $DivIds . $ProjYears . "1";
    } else {
        return "2" . $DivIds . $ProjYears . (substr($data["ProjCode"], 7) + 1);
    }
}

?>
