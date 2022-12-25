<!DOCTYPE html>
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
                        <h2>About Us</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">About Us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Food Start -->
        <div class="food mt-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="food-item">
                            <i class="flaticon-cocktail"></i>
                            <h2>รายการที่สั่ง</h2>
                            <table style="width:100%" border="1">
                              <tr>
                                <!--<th>ที่</th>-->
                                <th >คิวที่</th>
                                <th style="text-align: center">วันที่สั่งรายการ/เวลา</th>
                                <th style="text-align: center">จำนวนเงิน</th>
                                <th style="text-align: center">พิมพ์ใบเสร็จ</th>
                              </tr>
                              <?php
                              $result_group2 = $db->select("*" , "main_order","date_order ='$date_check' order by id desc ");
                              $numorder = 1; $sell_all=0;
                              while($row_group = $db->fetch_array($result_group2)){
                                    $id_order = $row_group["id"];
                                    $queue_order = $row_group["queue_order"];
                                    $total_order = $row_group["total_order"];
                                    $number_order = $row_group["queue_order"];
                                    $date_order =  $row_group["date_action"];
                                    $date_orderadd =  $row_group["date_order"];
                                    $status =  $row_group["status"];
                              ?>
                              <tr>
                                <!--<td style="text-align: center"><?=$numorder?></td>-->
                                <td style="text-align: center"><?=$number_order?></td>
                                <td style="text-align: center"><?=$date_order?></td>
                                <td style="text-align: center"><?=$total_order?></td>

                                <td style="text-align: center">
                                  <?php if($status == 'yes'){ ?>
                                  <a target="_blank" href="export_pdf/views/receipt.php?part=<?php echo md5("update_jpt");?>&date_orderadd=<?=$date_orderadd?>&q=<?=$queue_order?>&date_order=<?=$date_order?>&total_order=<?=$total_order?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    <span class="badge badge-sm bg-gradient-danger">พิมพ์ใบเสร็จ</span>
                                  </a>
                                <?php } ?>
                                  <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_1" data-whatever="<?=$id_menu_order;?>:<?=$menu_name[$id_menu_order];?>">พิมพ์ใบเสร็จ</button>-->
                                </td>
                              </tr>
                              <?php $numorder = $numorder+1;
                                    $sell_all = $sell_all+($menu_price[$id_menu_order]*$number_order);
                                }

                                ?>

                              <tr>
                                <!--<th></th>-->
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>

                            </table>

                            <!--<table style="width:100%" border="1">
                              <tr>
                                <th>จำนวน</th>
                                <th>รายการอาหาร</th>
                                <th>จำนวนเงิน</th>
                              </tr>
                              <tr>
                                <td style="text-align: center">Jill</td>
                                <td style="text-align: left">Smith</td>
                                <td style="text-align: center">50</td>
                              </tr>
                              <tr>
                                <td style="text-align: center">Eve</td>
                                <td style="text-align: left">Jackson</td>
                                <td style="text-align: center">94</td>
                              </tr>
                              <tr>
                                <td style="text-align: center">John</td>
                                <td style="text-align: left">Doe</td>
                                <td style="text-align: center">80</td>
                              </tr>
                              <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                              <tr>
                                <td style="text-align: center"></td>
                                <td style="text-align: left">จำนวนเงินทั้งสิ้น</td>
                                <td style="text-align: center">200</td>
                              </tr>
                            </table>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Food End -->

        <!-- Video Modal Start-->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Modal End -->


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
