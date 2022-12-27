
<html>
<?php
  error_reporting (E_ALL ^ E_NOTICE);
  date_default_timezone_set('Asia/Bangkok');


  include_once "../../inc/config.inc.php";
  include_once "../../inc/class/user_session.class.php";
  include_once "../../inc/class/db/db.php";
  include_once "../../inc/function.php";


  $action_date = date("Y-m-d H:i:s");
  $logout_date = date("Y-m-d");
  $logout_time = date("H:i");

  $date_order = $_REQUEST['date_order'];
  $queue_order = $_REQUEST['q'];
  $date_order_action = $_REQUEST['date_order'];
  $date_orderadd =  $_REQUEST['date_orderadd'];
  $total_order =  $_REQUEST['total_order'];
?>
<title>ใบเสร็จรับเงิน</title>
<head>
<meta charset="utf-8">
<link href="css/css.css" rel="stylesheet">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/paper.css">
  <link href="css/css1.css" rel="stylesheet">
  <!--<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
  <link href="css/css2.css" rel="stylesheet">


  <style>
    body   { font-family: Mitr; height:AUTO; }
    p.center  { font-family: 'Noto Sans Thai', sans-serif; font-size: 35pt; font-weight: bold; text-align: center; }
    p.wifi  { font-family: Monospace ; font-size: 35pt; font-weight: bold; text-align: center; line-height: 5mm }
    p.title {font-family: Monospace ; font-size: 35pt; font-weight: bold;}
	  #pdf   { text-align:justify; height:AUTO; }
    h1     { font-family: 'Noto Sans Thai', cursive; font-size: 60pt; line-height: 18mm; text-align:center;}
    h2, h3 { font-family: 'Noto Sans Thai', sans-serif; font-size: 35pt; line-height: 7mm; text-align:center; }
    h4     { font-size: 32pt; line-height: 14mm }
    h2 + p { font-size: 18pt; line-height: 7mm }
    h3 + p { font-size: 14pt; line-height: 7mm }
    li     { font-size: 11pt; line-height: 5mm }
    h1      { margin: 0 }
    h1 + ul { margin: 2mm 0 5mm }
    h2, h3  { margin: 0 3mm 3mm 0; float: left }
    h2 + p,
    h3 + p  { margin: 0 0 3mm 50mm }
    h4      { font-family: 'Noto Sans Thai', sans-serif; font-size: 35pt; text-align:center; margin: 2mm 0 0 0mm; border-bottom: 1px solid black }
    h4 + ul { margin: 5mm 0 0 50mm }
    h5      { font-family: 'Noto Sans Thai', sans-serif; font-size: 35pt; text-align:right; }
    h6      { font-size: 22pt; text-align:center; }

  </style>
</head>
<?php
   $result_group2 = $db->select("*" , "main_order","date_order ='$date_orderadd' and queue_order ='$queue_order' order by id desc ");
   $row_group2 = $db->fetch_array($result_group2);
   $payment = $row_group2["payment"];
   $change_menu = $row_group2["change_menu"];
   $table_order = $row_group2["table_order"];
?>
<body onLoad='javascript:window.print();' class="A4 Portrait">
  <section class="sheet padding-0mm" id="pdf">
    <br><br><br><br><br>
    <h1>โต๊ะที่ No : <?=$table_order?></h1><br>
    <h1>ขนำไร่  ชายน้ำ</h1><br>
    <h4>วันที่ <?php echo $date_order;?> </h4>
    <?php






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

      $result_group2 = $db->select("*" , "cus_order","date_order ='$date_orderadd' and queue_order ='$queue_order' order by id asc ");

    ?>
    <article>
      <br>
      <table width="100%" >
        <tr height ="60">
            <td width="3%"><h2></h2></td>
            <td width="57%"><p class="title">รายการ</p></td>
            <td width="20%"><p class="center title">จำนวน</p></td>
            <td width="20%"><p class="center title">รวม</p></td>
        </tr>
        <tr height ="15">
            <td width="3%"><h2></h2></td>
            <td width="57%"><h2></h2></td>
            <td width="20%"><h2></h2></td>
            <td width="20%"><h2></h2></td>
        </tr>
      <?php
        $numorder = 1; $sell_all=0;
        $num_main_order2 = $db->num_rows($result_group2);
        while($row_group = $db->fetch_array($result_group2)){
              $queue_order = $row_group["queue_order"];
              $id_menu_order = $row_group["id_menu_order"];
              $number_order = $row_group["number_order"];

        ?>
        <tr height ="60">
            <td width="3%"><h2></h2></td>
            <td width="57%"><h2><?=$menu_name[$id_menu_order]?></h2></td>
            <td width="20%"><p class="center"><?=$number_order?></p></td>
            <td width="20%"><p class="center"><?=$number_order*$menu_price[$id_menu_order]?></p></td>

        </tr>
        <?php $numorder = $numorder+1;
              $sell_all = $sell_all+($menu_price[$id_menu_order]*$number_order);
          }
          ?>
      </table>
      <br><br>
      <h4><?=$num_main_order2?> รายการ Total <?=$total_order?> THB </h4>
      <h4>Cash <?=$payment?> THB : Change <?=$change_menu?> THB </h4>
      <h4>Thank You</h4>
      <div>
        <p class="wifi">WiFi : Monmai-N / Monmai-AC</p>
        <p class="wifi">Password WiFi : 10023570</p>
      </div>
    </article>
  </section>
</body>
</html>
