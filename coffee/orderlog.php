<!DOCTYPE html>
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
        <script src="css/sweetalert.min.js"></script>
        <?php
              error_reporting (E_ALL ^ E_NOTICE);
              date_default_timezone_set('Asia/Bangkok');
              include_once "inc/config.inc.php";
              include_once "inc/class/user_session.class.php";
              include_once "inc/class/db/db.php";
              include_once "inc/function.php";

              $TimeDate_Action = date("Y-m-d H:i:s");
              $date_check = date("Y-m-d");

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

              $id_order = $_REQUEST['id_order'];


              $result_menu_price = $db->select("id, selling_price", "menu_order", " status ='yes' ");
               while($row_menu_price = $db->fetch_array($result_menu_price))
               {
                 $menu_price[$row_menu_price['id']] = $row_menu_price['selling_price']; //---------- สร้างอะเรย์
               }



              $recipient = explode(":", $_REQUEST["recipient-name"]);
              $numorder = $_REQUEST['numorder'];

              $cmdsave = $_REQUEST['cmdsave'];
              if($cmdsave == 'Regiter_P'){
                $main_order = $_REQUEST['order1'];
                $var2 = $_REQUEST['var2'];  //เงินที่สั่งสินค้า
                $var3 = $_REQUEST['var3'];  //เงินที่ลูกค้าให้มา
                $var4 = $_REQUEST['var4'];  //เงินทอน
                $result_up_cus_order = $db->update("main_order", "date_action_pay='$TimeDate_Action',total_order='$var2',payment='$var3',change_menu='$var4',status='yes'", "date_order ='$date_check' and queue_order ='$main_order' ");
                ?>
                <script langquage='javascript'>
                    //alert('<?= $alertstatus ?>');
                    //window.location.href = "export_pdf/views/receipt.php?part=<?php echo md5("update_jpt");?>&date_orderadd=<?=$date_check?>&q=<?=$main_order?>&date_order=<?=$TimeDate_Action?>&total_order=<?=$var2?>";
                    window.open('export_pdf/views/receipt.php?part=<?php echo md5("update_jpt");?>&date_orderadd=<?=$date_check?>&q=<?=$main_order?>&date_order=<?=$TimeDate_Action?>&total_order=<?=$var2?>','_blank');
                    //window.location = "index.php";
                </script>
                <?php
              }
              if($numorder != ''){
                $result_group1 = $db->select("*" , "main_order","date_order ='$date_check' and status ='yes' order by id desc limit 1");
                $num_main_order = $db->num_rows($result_group1);
                if($num_main_order == 0){
                  $result_group2 = $db->select("*" , "main_order","date_order ='$date_check' and status ='no' order by id desc limit 1");
                  $num_main_order2 = $db->num_rows($result_group2);
                  if($num_main_order2 == 0){
                    $field_arpay = " `id`,`queue_order`, `date_order`, `date_action`, `status`";
                    $data_arpay = " '','1', '$date_check', '$TimeDate_Action', 'no'";
                    $result_arpay = $db->insert("main_order", "$field_arpay", "$data_arpay");

                    $id_menu_order = $recipient[0];
                    $total_order = $menu_price[$id_menu_order]*$numorder;

                    $field_order = " `id`,`queue_order`, `date_order`, `date_action`, `id_menu_order`, `number_order`, `total_order`";
                    $data_order = " '','1', '$date_check', '$TimeDate_Action', '$recipient[0]', '$numorder', '$total_order'";
                    $result_order = $db->insert("cus_order", "$field_order", "$data_order");

                    ?>
                    <script langquage='javascript'>
                        //alert('<?= $alertstatus ?>');
                        window.location = "index.php";
                    </script>
                    <?php
                    }else{
                    $row_group2 = $db->fetch_array($result_group2);
                    $queue_order = $row_group2["queue_order"];

                    $result_group3 = $db->select("*" , "cus_order","date_order ='$date_check' and queue_order ='$queue_order' and id_menu_order ='$recipient[0]' ");
                    $num_main_order3 = $db->num_rows($result_group3);
                    if($num_main_order3 == 0){
                      $id_menu_order = $recipient[0];
                      $total_order = $menu_price[$id_menu_order]*$numorder;

                      $field_order = " `id`,`queue_order`, `date_order`, `date_action`, `id_menu_order`, `number_order`, `total_order`";
                      $data_order = " '','$queue_order', '$date_check', '$TimeDate_Action', '$recipient[0]', '$numorder', '$total_order'";
                      $result_order = $db->insert("cus_order", "$field_order", "$data_order");
                    }else{
                      if($numorder == 'cancel'){
                        $result_del = $db->delete("cus_order", "date_order ='$date_check' and queue_order ='$queue_order' and id_menu_order ='$recipient[0]'");
                      }else{
                        $id_menu_order = $recipient[0];
                        $total_order = $menu_price[$id_menu_order]*$numorder;

                        $result_up_cus_order = $db->update("cus_order", "date_action='$TimeDate_Action',id_menu_order='$recipient[0]',number_order='$numorder',total_order='$total_order'", "date_order ='$date_check' and queue_order ='$queue_order' and id_menu_order ='$recipient[0]'  ");
                      }

                    }
                    ?>
                    <script langquage='javascript'>
                        //alert('<?= $alertstatus ?>');
                        window.location = "index.php";
                    </script>
                    <?php

                    }
                  }else{
                    //$result_group2 = $db->select("*" , "main_order","date_order ='$date_check' and status ='no' order by id desc limit 1");
                    //$num_main_order2 = $db->num_rows($result_group2);
                    $row_group1 = $db->fetch_array($result_group1);
                    $queue_order = $row_group1["queue_order"];
                    $queue_order_last = $queue_order+1;

                    $result_group2 = $db->select("*" , "main_order","date_order ='$date_check' and status ='no' order by id desc limit 1");
                    $num_main_order2 = $db->num_rows($result_group2);
                    if($num_main_order2 == 0){
                      $field_arpay = " `id`,`queue_order`, `date_order`, `date_action`, `status`";
                      $data_arpay = " '','$queue_order_last', '$date_check', '$TimeDate_Action', 'no'";
                      $result_arpay = $db->insert("main_order", "$field_arpay", "$data_arpay");

                      $id_menu_order = $recipient[0];
                      $total_order = $menu_price[$id_menu_order]*$numorder;

                      $field_order = " `id`,`queue_order`, `date_order`, `date_action`, `id_menu_order`, `number_order`, `total_order`";
                      $data_order = " '','$queue_order_last', '$date_check', '$TimeDate_Action', '$recipient[0]', '$numorder', '$total_order'";
                      $result_order = $db->insert("cus_order", "$field_order", "$data_order");

                      ?>
                      <script langquage='javascript'>
                          //alert('<?= $alertstatus ?>');
                          window.location = "index.php";
                      </script>
                      <?php
                      }else{
                      $row_group2 = $db->fetch_array($result_group2);
                      $queue_order = $row_group2["queue_order"];

                      $result_group3 = $db->select("*" , "cus_order","date_order ='$date_check' and queue_order ='$queue_order' and id_menu_order ='$recipient[0]' ");
                      $num_main_order3 = $db->num_rows($result_group3);
                      if($num_main_order3 == 0){
                        $id_menu_order = $recipient[0];
                        $total_order = $menu_price[$id_menu_order]*$numorder;

                        $field_order = " `id`,`queue_order`, `date_order`, `date_action`, `id_menu_order`, `number_order`, `total_order`";
                        $data_order = " '','$queue_order', '$date_check', '$TimeDate_Action', '$recipient[0]', '$numorder', '$total_order'";
                        $result_order = $db->insert("cus_order", "$field_order", "$data_order");
                      }else{
                        if($numorder == 'cancel'){
                          $result_del = $db->delete("cus_order", "date_order ='$date_check' and queue_order ='$queue_order' and id_menu_order ='$recipient[0]'");
                        }else{
                          $id_menu_order = $recipient[0];
                          $total_order = $menu_price[$id_menu_order]*$numorder;

                          $result_up_cus_order = $db->update("cus_order", "date_action='$TimeDate_Action',id_menu_order='$recipient[0]',number_order='$numorder',total_order='$total_order'", "date_order ='$date_check' and queue_order ='$queue_order' and id_menu_order ='$recipient[0]'  ");
                        }

                      }
                      ?>
                      <script langquage='javascript'>
                          //alert('<?= $alertstatus ?>');
                          window.location = "index.php";
                      </script>
                      <?php

                      }


                    ?>
                    <script langquage='javascript'>
                        //alert('<?= $alertstatus ?>');
                        window.location = "index.php";
                    </script>
                    <?php

                }
              }
        ?>
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


        <!-- Food Start -->
        <div class="food mt-0">
            <div class="container">
                <div class="row align-items-center">
                        <div class="food-item">
                            <i class="flaticon-cocktail"></i>
                            <?php
                              $result_group2 = $db->select("*" , "main_order","date_order ='$date_check' and id ='$id_order' ");
                              $num_main_order2 = $db->num_rows($result_group2);
                              if($num_main_order2 == '1'){
                                $row_group2 = $db->fetch_array($result_group2);
                                $queue_order = $row_group2["queue_order"];

                                $result_menu_order = $db->select("id, menu", "menu_order", " status ='yes' ");
                                 while($row_menu_order = $db->fetch_array($result_menu_order))
                                 {
                                   $menu_name[$row_menu_order['id']] = $row_menu_order['menu']; //---------- สร้างอะเรย์
                                 }

                                 $result_menu_price = $db->select("id, selling_price", "menu_order", " status ='yes' ");
                                  while($row_menu_price = $db->fetch_array($result_menu_price))
                                  {
                                    $menu_price[$row_menu_price['id']] = $row_menu_price['selling_price']; //---------- สร้างอะเรย์
                                  }
                              }

                            ?>
                            <h2>Order Menu คิว (Queue) ที่ <?=$queue_order?></h2>
                            <a href="about.php?index=2" class="nav-item nav-link active">Menu ที่สั่ง</a>
                        </div>
                        <?php
                        if($num_main_order2 == '1'){
                          $result_group2 = $db->select("*" , "cus_order","date_order ='$date_check' and queue_order ='$queue_order' order by id asc ");
                        ?>
                        <table style="width:100%" border="1">
                          <tr>
                            <th>ที่</th>
                            <th >รายการ</th>
                            <th style="text-align: center">จำนวน</th>
                            <th style="text-align: center">ราคา</th>
                            <th style="text-align: center">จำนวนเงิน</th>
                            <th style="text-align: center">รวมทั้งสิ้น</th>
                            <th style="text-align: center">แก้ไข/ยกเลิก</th>
                          </tr>
                          <?php
                          $numorder = 1; $sell_all=0;
                          while($row_group = $db->fetch_array($result_group2)){
                                $queue_order = $row_group["queue_order"];
                                $id_menu_order = $row_group["id_menu_order"];
                                $number_order = $row_group["number_order"];
                          ?>
                          <tr>
                            <td style="text-align: center"><?=$numorder?></td>
                            <td style="text-align: left"><?=$menu_name[$id_menu_order]?></td>
                            <td style="text-align: center"><?=$number_order?></td>
                            <td style="text-align: center"><?=$menu_price[$id_menu_order]?></td>
                            <td style="text-align: center"><?=$menu_price[$id_menu_order]*$number_order?></td>
                            <td style="text-align: center">บาท</td>
                            <td style="text-align: center">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_1" data-whatever="<?=$id_menu_order;?>:<?=$menu_name[$id_menu_order];?>">แก้ไข/ยกเลิก Order</button>
                            </td>
                          </tr>
                          <?php $numorder = $numorder+1;
                                $sell_all = $sell_all+($menu_price[$id_menu_order]*$number_order);
                            }

                            ?>

                          <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                          <tr>
                            <td style="text-align: center"></td>
                            <td style="text-align: center"></td>
                            <td style="text-align: center"></td>
                            <td style="text-align: left">จำนวนเงินทั้งสิ้น</td>
                            <td style="text-align: center"><?=$sell_all?></td>
                            <td style="text-align: center">บาท</td>
                            <td style="text-align: center">
                              <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class='btn btn-warning ' onclick="loadAndShowModal();">ยืนยัน  Order  สินค้า</a>
                                        <!--<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal_2" data-whatever="Order Menu คิว (Queue)ที่ : <?=$queue_order;?>">ยืนยัน  Order  สินค้า</button>-->
                                    </div>
                                </div>
                              </div>

                            <script   src="css/jquery-3.5.1.min.js"></script>
                            <script   src="css/bootstrap.min.js"></script>
                            <div id="contianer_modals"></div>
                              <script>
                                  window.onload = function() {
                                  document.getElementById("number3").focus();
                                  }
                              </script>
                              <script>
                                  function loadAndShowModal(){
                                      var post = new Object();
                                      post.name = 'Order Menu คิว (Queue)ที่ :<?=$queue_order;?>'
                                      post.order1 = '<?=$queue_order;?>'
                                      post.description = '<?=$sell_all?>';

                                      $('#contianer_modals').load('modals.php',post,function(){
                                          $("#modal").modal('show');
                                      });
                                  }
                                  </script>


                            </td>
                          </tr>
                        </table>
                      <?php } ?>
                </div>
            </div>
        </div>
        <!-- Food End -->


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
                                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="<?=$row_group1["id"];?>:<?=$row_group1["menu"];?>">เลือกรายการ <?=$row_group1["menu"];?></button>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>-->
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">รายการสินค้า:</label>
                    <input type="text" name="recipient-name" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="recipient-order" class="control-label">จำนวน:</label>
                    <select id="numorder" name="numorder" class="form-control" required="required">
                      <!-- <option value="">0 </option> -->
                      <?php for ($i=1 ; $i <= 50  ; $i++ ) { ?>
                        <option value="<?=$i?>"><?=$i?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">ส่ง Order</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>-->
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">รายการสินค้า:</label>
                    <input type="text" name="recipient-name" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="recipient-order" class="control-label">จำนวน:</label>
                    <select id="numorder" name="numorder" class="form-control" required="required">
                      <!-- <option value="">0 </option> -->
                      <option value="cancel">ยกเลิกรายการ</option>
                      <?php for ($i=1 ; $i <= 50  ; $i++ ) { ?>
                        <option value="<?=$i?>"><?=$i?> </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">ส่ง Order</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>-->
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">คิวที่:</label>
                    <input type="text" name="recipient-name" class="form-control" id="recipient-name">
                  </div>
                  <div class="form-group">
                    <label for="recipient-order-all" class="control-label">จำนวนเงิน:</label>
                    <input type="text" name="recipient-order-all" class="form-control" id="recipient-order-all">
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">ส่ง Order</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>

        <!-- Menu End -->


        <!-- Footer Start -->
        <div class="footer">
            <div class="copyright">
                <div class="container">
                <p>Copyright &copy; <a href="https://www.facebook.com/profile.php?id=100087736943338">Monmai Coffee Hut</a>, All Right Reserved.</p>
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
        <script type="text/javascript">
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Order Menu ')
                modal.find('.modal-body input').val(recipient)
              })
        </script>

        <script type="text/javascript">
            $('#exampleModal_1').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Order Menu ')
                modal.find('.modal-body input').val(recipient)
              })
        </script>
        <script type="text/javascript">
            $('#exampleModal_2').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Order Menu ')
                modal.find('.modal-body input').val(recipient)
              })
        </script>
    </body>
</html>
