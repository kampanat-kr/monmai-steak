<?php

    function label_menu($txt_label,$url,$target,$frame="")
    {
        $label = "<label "
                 . " style='color:#0033cc'"
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.open('$url','$target');$frame\""
                 . " />$txt_label</label>";
        return $label;
    }

    function label_link($txt_label,$url,$target,$frame="")
    {
        $label = "<label "
                 . " style='color:blue'"
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.open('$url','$target');$frame\""
                 . " />$txt_label</label>";
        return $label;
    }

    function label_link_menu($txt_label,$url,$target,$frame="")
    {
        $label = "<label "
                 . " style='color:blue'"
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.open('$url','$target');$frame\""
                 . " />$txt_label</label>";
        return $label;
    }

    function label_link_dialog($txt_label,$url)
    {
        $label = "<label "
                 . " style='color:blue'"
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.showModalDialog('$url', 'null', 'dialogWidth:600px; dialogHeight:400px; center:yes; status:no;');\""
                 . " />$txt_label</label>";
        return $label;
    }

    function image_link_dialog($url, $img, $alt)
    {
        $img = "<img"
                 . " src=\"$img\""
                 . " alt=\"$alt\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.showModalDialog('$url', 'null', 'dialogWidth:600px; dialogHeight:400px; center:yes; status:no;');\""
                 . "/>";
        return $img;
    }

    function image_detail($url, $img, $alt)
    {
        $img = "<img"
                 . " src=\"$img\""
                 . " alt=\"$alt\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.open('$url','detail'); showframe();\""
                 . "/>";
        return $img;
    }
	
    function image_detail_delete_item($url, $img, $alt)
    {
        $img = "<img"
                 . " src=\"$img\""
                 . " alt=\"$alt\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.open('$url','detail');\""
                 . "/>";
        return $img;
    }

    function image_detail_size($url, $img, $alt)
    {
        $img = "<img"
                 . " src=\"$img\""
                 . " alt=\"$alt\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.open('$url','detail');\""
                 . "/>";
        return $img;
    }

    function image_detail_no_frame($url, $img, $alt)
    {
        $img = "<img"
                 . " src=\"$img\""
                 . " alt=\"$alt\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.open('$url','detail');\""
                 . "/>";
        return $img;
    }

    function image_detail_fullscreen($url, $img, $alt)
    {
        $img = "<img"
                 . " src=\"$img\""
                 . " alt=\"$alt\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"window.open('$url','detail'); fullscreen1();\""
                 . "/>";
        return $img;
    }

    function image_properties_detail($url)
    {
        return image_detail($url, "../images/application_properties.png", "Properties");
    }

    function image_modify_detail($url)
    {
        return image_detail($url, "../images/application_edit.png", "Modify");
    }

    function image_delete_detail($url)
    {
        return image_detail($url, "../images/application_delete.png", "Delete");
    }
	
    function image_delete_item_select($url)
    {
        return image_detail_delete_item($url, "../images/application_delete.png", "Delete");
    }

    function image_checkin_detail($url)
    {
        return image_detail($url, "../images/application_checkin.png", "Check In");
    }

    function image_checkout_detail($url)
    {
        return image_detail($url, "../images/application_checkout.png", "Check Out");
    }

    function image_view_detail($url)
    {
        return image_detail($url, "../images/application_view.png", "View");
    }

    function image_print_detail($url)
    {
        return image_detail($url, "../images/application_printer.png", "Print");
    }

    function image_share_detail($url)
    {
        return image_detail($url, "../images/application_mail.png", "Share");
    }

    function image_properties_detail_size($url)
    {
        return image_detail_size($url, "../images/application_properties_m.png", "Properties");
    }

    function image_modify_detail_size($url)
    {
        return image_detail_size($url, "../images/application_edit_m.png", "Modify");
    }

    function image_delete_detail_size($url)
    {
        return image_detail_size($url, "../images/application_delete_m.png", "Delete");
    }

    function image_checkin_detail_size($url)
    {
        return image_detail_size($url, "../images/application_checkin_m.png", "Check In");
    }

    function image_checkout_detail_size($url)
    {
        return image_detail_size($url, "../images/application_checkout_m.png", "Check Out");
    }

    function image_view_detail_size($url)
    {
        return image_detail_size($url, "../images/application_view_m.png", "View");
    }

    function image_print_detail_size($url)
    {
        return image_detail_size($url, "../images/application_printer_m.png", "Print");
    }

    function image_share_detail_size($url)
    {
        return image_detail_size($url, "../images/application_mail.png_m", "Share");
    }

    function image_restore_detail($url)
    {
        return image_detail($url, "../images/application_restore.png", "Restore");
    }

    function image_copy_detail($url)
    {
        return image_detail($url, "../images/copy.png", "Copy");
    }

    function image_newfolder_detail($url)
    {
        return image_detail($url, "../images/icon_folder.png", "New Folder");
    }

    function image_importfile_detail($url)
    {
        return image_detail($url, "../images/application_import.png", "Import File");
    }

    function image_new_request_detail($url)
    {
        return image_detail_fullscreen($url, "../images/add.png", "New Request");
    }

    function image_properties_request_detail($url)
    {
        return image_detail_fullscreen($url, "../images/application_properties.png", "Properties");
    }

    function image_modify_request_detail($url)
    {
        return image_detail_fullscreen($url, "../images/application_edit.png", "Modify");
    }
    
    function image_sethome_detail($url)
    {
        return image_detail_no_frame($url, "../images/home.png", "Set View at Home");
    }

    function image_home_detail($url)
    {
        return image_detail_no_frame($url, "../images/home.png", "Home");
    }


    function image_delete($url)
    {
        $img = "<img"
                 . " src=\"../images/application_delete.png\""
                 . " alt=\"Delete\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"page_delete('$url');\""
                 . "/>";
        return $img;
    }

    function image_refresh($url, $title)
    {
        $img = "<img"
                 . " src=\"../images/arrow-circle-double.png\" border=\"0\""
                 . " alt=\"Refresh\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"page_submit('$url');\""
				 . " align=\"absmiddle\""
                 . "/>";

        $lable = "<span"
                   . " style=\"color: FFFFFF; font-weight: bold;font-size: 12px;\">"
                   . "$title"
                   . "</span>";

        return $img."&nbsp".$lable;
    }

    function image_find_top($url)
    {
        $img = "<img"
                 . " src=\"../images/find.png\""
                 . " alt=\"Search\""
                 . " onmouseover=\"style.cursor = 'pointer'\""
                 . " onclick=\"page_submit('$url');\""
                 . "/>";
        return $img;
    }

    function image_add_bottom($url, $title)
    {
        $lable = "<label"
                   . " style=\"color: FFFFFF;\""
                   . " onmouseover=\"style.cursor = 'pointer'\""
                   . " onclick=\"window.open('$url','detail'); showframe();\">"
                   . "<img src=\"../images/add.png\" alt=\"$title\"/>"
                   . "<br>"
                   . "$title"
                   . "</span>";
        return $lable;
    }

    function image_hide_menu()
    {
        $img = "<img"
                  . " src=\"../images/show_menu.png\""
                  . " border=\"0\""
                  . " id=\"show\""
                  . " name=\"show\""
                  . " style=\"display:none; cursor: 'pointer'\""
                  . " alt=\"Show Menu\""
                  . " onclick=\"showmenu();\""
                  . "/>";

        return $img;
    }
   
?>
