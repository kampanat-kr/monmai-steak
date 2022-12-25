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
                  $result_group2 = $db->select("*" , "main_order","date_order ='$date_check'  order by id desc limit 1");
                  $num_main_order2 = $db->num_rows($result_group2);
                  if($num_main_order2 == 0){
                    $field_arpay = " `id`,`queue_order`, `date_order`, `date_action`, `status`, `table_order`";
                    $data_arpay = " '','1', '$date_check', '$TimeDate_Action', 'no', '$numorder'";
                    $result_arpay = $db->insert("main_order", "$field_arpay", "$data_arpay");
                    $table_order = mysql_insert_id()
                    //$id_menu_order = $recipient[0];
                    //$total_order = $menu_price[$id_menu_order]*$numorder;

                    //$field_order = " `id`,`queue_order`, `date_order`, `date_action`, `id_menu_order`, `number_order`, `total_order`, `table_order`";
                    //$data_order = " '','1', '$date_check', '$TimeDate_Action', '$recipient[0]', '0', '$total_order', '$total_order'";
                    //$result_order = $db->insert("cus_order", "$field_order", "$data_order");

                    ?>
                    <script langquage='javascript'>
                        //alert('<?= $alertstatus ?>');
                        window.location = "orderlog.php?part=454ace7cca81ce1ab81b7ff0f75df993&id_order=<?=$table_order?>";
                    </script>
                    <?php
                    }else{
                      $row_group2 = $db->fetch_array($result_group2);
                      $queue_order = $row_group2["queue_order"];
                      $queue_order_last = $queue_order+1;

                      $field_arpay = " `id`,`queue_order`, `date_order`, `date_action`, `status`, `table_order`";
                      $data_arpay = " '','$queue_order_last', '$date_check', '$TimeDate_Action', 'no', '$numorder'";
                      $result_arpay = $db->insert("main_order", "$field_arpay", "$data_arpay");
                      $table_order = mysql_insert_id();
                    }
                    ?>
                    <script langquage='javascript'>
                        //alert('<?= $alertstatus ?>');
                        window.location = "orderlog.php?part=454ace7cca81ce1ab81b7ff0f75df993&id_order=<?=$table_order?>";
                    </script>
                    <?php

                    }
                /*  }else{
                    //$result_group2 = $db->select("*" , "main_order","date_order ='$date_check' and status ='no' order by id desc limit 1");
                    //$num_main_order2 = $db->num_rows($result_group2);
                    $row_group1 = $db->fetch_array($result_group1);
                    $queue_order = $row_group1["queue_order"];
                    $queue_order_last = $queue_order+1;

                    $field_arpay = " `id`,`queue_order`, `date_order`, `date_action`, `status`, `table_order`";
                    $data_arpay = " '','$queue_order_last', '$date_check', '$TimeDate_Action', 'no', '$numorder'";
                    $result_arpay = $db->insert("main_order", "$field_arpay", "$data_arpay");
                    $table_order = mysql_insert_id()

                      ?>
                      <script langquage='javascript'>
                          //alert('<?= $alertstatus ?>');
                          window.location = "orderlog.php?part=454ace7cca81ce1ab81b7ff0f75df993&id_order=<?=$table_order?>";
                      </script>
                      <?php
                      }


                }
                */

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
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal_3">เลือกโต๊ะ</button>
                            <?php
                              //$result_group2 = $db->select("*" , "main_order","date_order ='$date_check' and status ='no' order by id desc limit 1");
                              //$num_main_order2 = $db->num_rows($result_group2);
                              /*if($num_main_order2 == '1'){
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
                              }*/

                            ?>
                            <!--<h2>Order Menu คิว (Queue) ที่ <?=$queue_order?></h2>
                            <a href="about.php?index=2" class="nav-item nav-link active">Menu ที่สั่ง</a>-->
                        </div>
                        <?php
                        $numorder =1 ;
                        $result_group2 = $db->select("*" , "main_order","date_order ='$date_check' and status ='no' order by id desc");

                        ?>
                        <table style="width:100%" border="1">
                          <tr>
                            <th>คิวที่</th>
                            <th>โต๊ะ</th>
                            <th style="text-align: center">รายการ</th>
                            <th style="text-align: center">จำนวนเงิน</th>
                            <th style="text-align: center">แก้ไข/ยกเลิก</th>
                          </tr>
                          <?php
                          while($row_group = $db->fetch_array($result_group2)){
                                $id_order = $row_group["id"];
                                $queue_order = $row_group["queue_order"];
                                $id_menu_order = $row_group["id_menu_order"];
                                $number_order = $row_group["number_order"];
                                $table_order =  $row_group["table_order"];
                                //$total_order =  $row_group["total_order"];

                                $result_group1 = $db->select("sum(total_order) as total_order" , "cus_order","date_order ='$date_check' and queue_order ='$queue_order' ");
                                //$num_main_order1 = $db->num_rows($result_group1);
                                $row_group1 = $db->fetch_array($result_group1);
                                $total_order =  $row_group1["total_order"];

                                $result_group5 = $db->select("queue_order" , "cus_order","date_order ='$date_check' and queue_order ='$queue_order' ");
                                $num_main_order1 = $db->num_rows($result_group5);
                          ?>
                          <tr>
                            <td style="text-align: center"><?=$numorder?></td>
                            <td style="text-align: left"><?=$table_order?></td>
                            <td style="text-align: center"><?=$num_main_order1?></td>
                            <td style="text-align: center"><?=$total_order?></td>
                            <td style="text-align: center">
                              <a href="orderlog.php?part=<?php echo md5("update_jpt");?>&id_order=<?=$id_order?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                <span class="badge badge-sm bg-gradient-danger">ดูรายการอาหาร</span>
                              </a>
                            </td>
                            <!--<td style="text-align: center">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_1" data-whatever="<?=$id_menu_order;?>:<?=$menu_name[$id_menu_order];?>">แก้ไข/ยกเลิก Order</button>
                            </td>-->
                          </tr>
                          <?php
                                $numorder = $numorder+1;
                                //$sell_all = $sell_all+($menu_price[$id_menu_order]*$number_order);
                            }

                            ?>

                          <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>

                          </tr>

                        </table>

                </div>
            </div>
        </div>
        <!-- Food End -->


        <!-- Menu Start -->










        <!--<div class="modal fade" id="exampleModal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">

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
        </div>-->

        <div class="modal fade" id="exampleModal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>-->
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                  <div class="form-group">
                    <label for="recipient-order" class="control-label">เลือกโต๊ะ:</label>
                    <select id="numorder" name="numorder" class="form-control" required="required">
                      <option value="">เลือกโต๊ะ </option>
                      <?php for ($i=1 ; $i <= 50  ; $i++ ) { ?>
                        <option value="<?=$i?>"><?=$i?> </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">เลือก</button>
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
        <script type="text/javascript">
            $('#exampleModal_3').on('show.bs.modal', function (event) {
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
