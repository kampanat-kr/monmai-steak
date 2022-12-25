<?php
    class orcl
    {
        function fnc_orcl_select($field,$table,$condition)
        {
            $conn = oci_connect('HRMS', 'HRMS', '172.17.46.93/TRAIN');
            if (!$conn)
            {
                echo "Connection Fail";
            }
            else
            {
                $stid = oci_parse($conn,"SELECT".$field." FROM ".$table);
                oci_execute($stid);
                oci_execute($stid);
                $result = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
                return $result;
            }
        }
    }
?>
