<?php
    class mail_notify{
        public static function notify_person($str_to,$str_subject,$masssage){
            //$str_to = "seksan.m@samtel.samartcorp.com";
        
            //$mail_from = "Sale Report System";
            $mail_from = "STAR_SYSTEM@samartcorp.com";

            //$str_header = "AAAAAAA";
            $str_header  = "MIME-Version: 1.0\r\n";
            $str_header .= "Content-type: text/html; charset=UTF-8\r\n";
            $str_header .= "From: STAR SYSTEM <".$mail_from.">\r\n";
            $str_header .= "Reply-to: ".$mail_from." <".$mail_from.">\r\n";
            $str_header .= "X-Priority: 3\r\n";
            $str_header .= "X-Mailer: PHP mailer\r\n";
            $mail_send = mail(trim($str_to),$str_subject,$masssage,$str_header,$mail_from);
			
            if($mail_send){
                echo "Send ";
            }

            return $mail_send;
        }
    }
?>
