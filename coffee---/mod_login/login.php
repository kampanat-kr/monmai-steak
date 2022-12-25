<?php
    error_reporting(E_ALL ^ E_NOTICE);
    include_once "../inc/config.inc.php";
    include_once "../inc/class/user_session.class.php";
    include_once "../inc/class/db/db.php";

    date_default_timezone_set('Asia/Bangkok');
    $action_date = date("Y-m-d H:i:s");
    $logout_date = date("Y-m-d");
    $logout_time = date("H:i:s");

    $OutType = $_REQUEST['OutType'];
    $LogId = $_REQUEST['LogId'];
       if($LogId != ''){
          $result_amphur = $db->update("log_admin_login", "logout_date='$logout_date',logout_time='$logout_time'", "online_log_login_id='$LogId'  ");
          $result = $db->delete("online_log", "login_id=$LogId");
          session_destroy();
          ?>
          <script langquage='javascript'>
              window.location = "../index.php";
          </script>
          <?php
       }



 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Bootstrap 5  Login Page Design</title>
  </head>
  <body>
    <section class="form-01-main">
      <div class="form-cover">
      <div class="container">
        <form role="form text-left" action="../load_config.php">
        <div class="row">
          <div class="col-md-12">
            <div class="form-sub-main">
              <div class="_main_head_as">
                <a href="#">
                  <img src="assets/images/vector.png">
                </a>
              </div>
              <div class="form-group">
                  <input id="username" name="Username" class="form-control _ge_de_ol" type="text" placeholder="Enter Username" required="" aria-required="true">
              </div>
              <div class="form-group">
                <input id="password" type="password" class="form-control" name="Password" placeholder="********" required="required">
                <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
              </div>
              <div class="form-group">
                <div class="btn_uy">
                  <button type="submit" ><span>Login</span></span></button>
                  <!--<a href="#"><span>Login</span></a>-->
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
      </div>
    </section>
  </body>
</html>
