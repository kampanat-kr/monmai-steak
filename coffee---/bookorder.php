<!DOCTYPE html>
<?php
      error_reporting (E_ALL ^ E_NOTICE);
      date_default_timezone_set('Asia/Bangkok');
      include_once "inc/config.inc.php";
      include_once "inc/class/user_session.class.php";
      include_once "inc/class/db/db.php";
      include_once "inc/function.php";

      $user_name = trim(user_session::get_user_name());
      $username = trim(user_session::get_user_name());
      $LogId = trim(user_session::get_log_id()); // รับไอดี login จาก session แล้วนำไปอ่านสถานะการออนไลน์

      $result_group2 = $db->select("firstname,lastname,moo,ban,ampId,tumbol,ampId,RoleId,username" , "sys_member","id='$username' ");
      $row_group2 = $db->fetch_array($result_group2);
      $cid  = $row_group2["username"];
      $firstname  = $row_group2["firstname"];
      $lastname =  $row_group2["lastname"];
      $ampId  = $row_group2["ampId"];
      $moo  = $row_group2["moo"];
      $tumbol  = $row_group2["tumbol"];
      $ban  = $row_group2["ban"];
      $RoleId  = $row_group2["RoleId"];
      $ampId =  $row_group2["ampId"];

      $cmdupdate_menu =  $_REQUEST['cmdupdate_menu'];
      if($cmdupdate_menu == 'cmdupdate_menu'){
         $id_menu_order = $_REQUEST['id'];
         $type_name =  $_REQUEST['type_name'];
         $menu_name =  $_REQUEST['menu_name'];
         $selling_price =  $_REQUEST['selling_price'];
         $cost_price =  $_REQUEST['cost_price'];
         $result_up_cus_order = $db->update("menu_order", "type='$type_name',menu='$menu_name',selling_price='$selling_price',cost_price='$cost_price'", "id ='$id_menu_order'  ");
         ?>
         <script langquage='javascript'>
             //alert('<?= $alertstatus ?>');
             window.location = "bookorder.php?index=3";
         </script>
         <?php
      }
      if($cmdupdate_menu == 'cmdadd_menu'){
        $type_name =  $_REQUEST['type_name'];
        $menu_name =  $_REQUEST['menu_name'];
        $selling_price =  $_REQUEST['selling_price'];
        $cost_price =  $_REQUEST['cost_price'];

        $field_order = " `id`,`type`, `menu`, `selling_price`, `cost_price`, `status`";
        $data_order = " '','$type_name', '$menu_name', '$selling_price', '$cost_price', 'yes'";
        $result_order = $db->insert("menu_order", "$field_order", "$data_order");
        ?>
        <script langquage='javascript'>
            //alert('<?= $alertstatus ?>');
            window.location = "bookorder.php?index=3";
        </script>
        <?php
      }


      $cmd = $_REQUEST['cmd'];
      $type_update =  $_REQUEST['type'];
      if($cmd == 'cmdupdate'){
        $id_menu_order = $_REQUEST['id'];
        $menu = $_REQUEST['menu'];

        $result_menu_order = $db->select("*" , "menu_order","id='$id_menu_order' ");
        $row_menu_order = $db->fetch_array($result_menu_order);
        $type =  $row_menu_order["type"];
        $selling_price =  $row_menu_order["selling_price"];
        $cost_price =  $row_menu_order["cost_price"];
      }
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Monmai Coffee Hut</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">
        <!-- Google Font -->
        <link href="scc/font.css" rel="stylesheet">
        <!-- CSS Libraries -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">

        <script language="JavaScript">
              function Check_txt(){
              //*******************************
              if(document.getElementById('filUpload').value!=""){
              var fty=new Array(".png",".jpg",".jpeg"); // ประเภทไฟล์ที่อนุญาตให้อัพโหลด
                 var a=document.frm1.filUpload.value; //กำหนดค่าของไฟล์ใหกับตัวแปร a
                 var permiss=0; // เงื่อนไขไฟล์อนุญาต
                 a=a.toLowerCase();
                 if(a !=""){
                     for(i=0;i<fty.length;i++){ // วน Loop ตรวจสอบไฟล์ที่อนุญาต
                         if(a.lastIndexOf(fty[i])>=0){  // เงื่อนไขไฟล์ที่อนุญาต
                             permiss=1;
                             break;
                         }else{
                             continue;
                         }
                     }
                     if(permiss==0){
                         swal("", "อัพโหลดได้เฉพาะไฟล์ png jpg jpeg !!", "warning");
                         //alert("อัพโหลดได้เฉพาะไฟล์ png jpg jpeg");
                         document.getElementById('filUpload').value="" ;
                         return false;
                     }
                 }
              }
              }
              //******************************

              </script>
    </head>

    <body>
        <!-- Nav Bar Start -->
        <?php
          include_once "mod/menu.php";
        ?>
        <!-- Nav Bar End -->


        <!-- Page Header Start -->
        <div class="page-header mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Menu Order</h2>
                    </div>

                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <div class="booking">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="booking-content">
                            <div class="section-header">
                                <p>เพิ่มเมนูเครื่องดื่ม/อาหาร/</p>
                                <h2>Book Your Table For Private Dinners & Happy Hours</h2>
                            </div>
                            <div class="about-text">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus. Aenean consectetur convallis porttitor. Aliquam interdum at lacus non blandit.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="booking-form">
                            <form name="frm1" method="post" enctype="multipart/form-data" onSubmit="return Check_txt()">
                              <div class="control-group">
                                  <div class="input-group">
                                      <select class="custom-select form-control" name="type_name" required="required">
                                          <option value="">ประเภท</option>
                                          <?php
                                          $result_typefood = $db->select("*", "typefood", " 1 ='1' ");
                                           while($row_typefood = $db->fetch_array($result_typefood))
                                           {
                                             if($type_update == $row_typefood["type"]){
                                             ?>
                                             <option selected value="<?=$row_typefood["type"]?>"><?=$row_typefood["id"]?> <?=$row_typefood["typename"]?></option>
                                           <?php }else{ ?>
                                              <option  value="<?=$row_typefood["type"]?>"><?=$row_typefood["id"]?> <?=$row_typefood["typename"]?></option>
                                           <?php } ?>
                                      <?php } ?>
                                      </select>
                                      <div class="input-group-append">
                                          <div class="input-group-text"><i class="fa fa-chevron-down"></i></div>
                                      </div>
                                  </div>
                              </div>
                                <div class="control-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="menu_name" value="<?=$menu?>" placeholder="รายการอาหาร/เครื่องดื่ม" required="required" autocomplete="Off" />
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="far fa-user"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="selling_price" value="<?=$selling_price?>" placeholder="ราคาจำหน่าย" required="required" />
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-mobile-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cost_price" value="<?=$cost_price?>" placeholder="ราคาต้นทุน" required="required" />
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-mobile-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="control-group">
                                    <div class="input-group">
                                        <input type="file" id="filUpload" name="filUpload[]" multiple="multiple" required/>
                                    </div>
                                </div>-->

                                <div>
                                    <button class="btn custom-btn" type="submit">บันทึกข้อมูล</button>
                                </div>
                              <?php if($cmd == 'cmdupdate'){ ?>
                                <input name="cmdupdate_menu" type="hidden" value="cmdupdate_menu" />
                                <input name="id" type="hidden" value="<?=$id_menu_order?>" />
                              <?php }else{ ?>
                                <input name="cmdupdate_menu" type="hidden" value="cmdadd_menu" />
                              <?php } ?>
                                <!--<input name="fmod" type="hidden" value="<?=$fmod;?>" />-->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu Start -->
        <div class="menu">
            <div class="container">
                <div class="menu-tab">
                    <ul class="nav nav-pills justify-content-center">
                      <?php
                      $result_group = $db->select("*" , "typefood","status ='yes'");
                      $num_typefood = $db->num_rows($result_group);
                      $num_count = 0;
                         while($row_group = $db->fetch_array($result_group)){
                           $id[]  =  $row_group["type"];
                           if($num_count == 0){ ?>
                             <li class="nav-item">
                                 <a class="nav-link active" data-toggle="pill" href="#<?=$row_group["type"]?>"><?=$row_group["typename"]?></a>
                             </li>
                      <?php  }else{ ?>
                           <li class="nav-item">
                               <a class="nav-link" data-toggle="pill" href="#<?=$row_group["type"]?>"><?=$row_group["typename"]?></a>
                           </li>
                      <?php  }
                            $num_count = $num_count+1;
                       }
                       ?>
                        <!--<li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#burgers">กาแฟ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#snacks">เครื่องดื่ม</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#beverages">ของหวาน/เบเกอรี่</a>
                        </li>-->
                    </ul>
                    <div class="tab-content">
                    <?php for ($i= 0; $i < $num_typefood ; $i++) {
                        if($i == 0){ ?>
                        <div id="<?=$id[$i]?>" class="container tab-pane active">
                    <?php }else{ ?>
                        <div id="<?=$id[$i]?>" class="container tab-pane ">
                    <?php } ?>
                          <div class="row">
                              <div class="col-lg-7 col-md-12">
                                <?php
                                    $result_group1 = $db->select("*" , "menu_order","type ='$id[$i]' and status='yes'");
                                    //$num_typefood = $db->num_rows($result_group);
                                    //$num_count = 0;
                                     while($row_group1 = $db->fetch_array($result_group1)){
                                  ?>
                                  <div class="menu-item">
                                      <div class="menu-img">
                                          <img src="img/menu-coffee.jpg" alt="Image">
                                      </div>
                                      <div class="menu-text">
                                          <h3><span><?=$row_group1["menu"];?></span> <strong>$<?=$row_group1["selling_price"];?></strong></h3>
                                          <br>
                                          <a  href="bookorder.php?index=3&cmd=cmdupdate&id=<?=$row_group1["id"];?>&type=<?=$row_group1["type"];?>&menu=<?=$row_group1["menu"];?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <button type="button" class="btn btn-success">แก้ไขข้อมูล <?=$row_group1["menu"];?></button>
                                          </a>

                                      </div>
                                  </div>
                                  <?php }  ?>
                              </div>
                              <!--<div class="col-lg-5 d-none d-lg-block">
                                  <img src="img/menu-coffee-img.jpg" alt="Image">
                              </div>-->
                          </div>

                      </div>
                      <?php }  ?>



                        <!--<div id="burgers" class="container tab-pane">
                            <div class="row">
                                <div class="col-lg-7 col-md-12">
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-burger.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Mini cheese Burger</span> <strong>$9.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-burger.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Double size burger</span> <strong>$11.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-burger.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Bacon, EGG and Cheese</span> <strong>$13.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-burger.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Pulled porx Burger</span> <strong>$18.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap1">Open modal for @getbootstrap1</button>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-burger.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Fried chicken Burger</span> <strong>$22.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap2">Open modal for @getbootstrap2</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-none d-lg-block">
                                    <img src="img/menu-burger-img.jpg" alt="Image">
                                </div>
                            </div>
                        </div>
                        <div id="snacks" class="container tab-pane fade">
                            <div class="row">
                                <div class="col-lg-7 col-md-12">
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-snack.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Corn Tikki - Spicy fried Aloo</span> <strong>$15.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-snack.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Bread besan Toast</span> <strong>$35.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-snack.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Healthy soya nugget snacks</span> <strong>$20.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-snack.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Tandoori Soya Chunks</span> <strong>$30.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-none d-lg-block">
                                    <img src="img/menu-snack-img.jpg" alt="Image">
                                </div>
                            </div>
                        </div>
                        <div id="beverages" class="container tab-pane fade">
                            <div class="row">
                                <div class="col-lg-7 col-md-12">
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-beverage.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Single Cup Brew</span> <strong>$7.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-beverage.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Caffe Americano</span> <strong>$9.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-beverage.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Caramel Macchiato</span> <strong>$15.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-beverage.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Standard black coffee</span> <strong>$8.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-img">
                                            <img src="img/menu-beverage.jpg" alt="Image">
                                        </div>
                                        <div class="menu-text">
                                            <h3><span>Standard black coffee</span> <strong>$12.00</strong></h3>
                                            <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-none d-lg-block">
                                    <img src="img/menu-beverage-img.jpg" alt="Image">
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
      </div>



        <!-- Menu End -->


        <!-- Footer Start -->
        <div class="footer">
            <div class="copyright">
                <div class="container">
                    <p>Copyright &copy; <a href="#">Your Site Name</a>, All Right Reserved.</p>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="css/jquery-3.4.1.min.js"></script>
        <script src="css/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
