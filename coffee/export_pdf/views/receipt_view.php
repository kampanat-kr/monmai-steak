<html>
<?php
  error_reporting (E_ALL ^ E_NOTICE);
  date_default_timezone_set('Asia/Bangkok');
  $action_date = date("Y-m-d H:i:s");
  $logout_date = date("Y-m-d");
  $logout_time = date("H:i");
?>
<title>ใบเสร็จรับเงิน</title>
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.2.3/paper.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300&display=swap" rel="stylesheet">
  <style>@page { size: A4 Portrait }
         @import 'https://fonts.googleapis.com/css?family=Kanit|Prompt';
  </style>
  <style>
    body   { font-family: Mitr; height:AUTO; }
	  #pdf   { text-align:justify; height:AUTO; }
    h1     { font-family: 'Noto Sans Thai', cursive; font-size: 60pt; line-height: 18mm; text-align:center;}
    h2, h3 { font-family: 'Noto Sans Thai', sans-serif; font-size: 35pt; line-height: 7mm; text-align:justify; }
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
    h6      { font-size: 35pt; text-align:right; }
  </style>
</head>
<body class="A4 Portrait">
  <section class="sheet padding-0mm" id="pdf">
    <br><br>
    <h1>ขนำไร่  ชายน้ำ : โต๊ะ 1</h1>
    <h4>วันที่ <?php echo $logout_date;?> เวลา <?php echo $logout_time;?></h4>
    <article>
      <br><br><h2>รายการอาหาร</h2><br><br><br>
      <table border="0" width="100%" >
          <tr height ="60">
              <td width="5%"><h2>1</h2></td>
              <td width="70%"><h2>เสต๊คหมู</h2></td>
              <td width="15%"><h2>99</h2></td>
              <td width="10%"><h2>บาท</h2></td>
          <tr>
            <tr height ="60">
                <td width="5%"><h2>1</h2></td>
                <td width="70%"><h2>วาฟเฟิล กล้วย</h2></td>
                <td width="15%"><h2>99</h2></td>
                <td width="10%"><h2>บาท</h2></td>
            <tr>
              <tr height ="60">
                  <td width="5%"><h2>1</h2></td>
                  <td width="70%"><h2>วาฟเฟิล โกโก้</h2></td>
                  <td width="15%"><h2>99</h2></td>
                  <td width="10%"><h2>บาท</h2></td>
              <tr>
                <tr height ="60">
                    <td width="5%"><h2>1</h2></td>
                    <td width="70%"><h2>เสต๊กเนื้อ</h2></td>
                    <td width="15%"><h2>119</h2></td>
                    <td width="10%"><h2>บาท</h2></td>
                <tr>
                  <tr height ="60">
                      <td width="5%"><h2>1</h2></td>
                      <td width="70%"><h2>เฟร้นฟราย</h2></td>
                      <td width="15%"><h2>59</h2></td>
                      <td width="10%"><h2>บาท</h2></td>
                  <tr>
                    <tr height ="60">
                        <td width="5%"><h2>1</h2></td>
                        <td width="70%"><h2>ปีกไก่ทอด</h2></td>
                        <td width="15%"><h2>69</h2></td>
                        <td width="10%"><h2>บาท</h2></td>
                    <tr>
      </table>
      <h4>รายการอาหาร 6 รายการ</h4><br><br>
      <h2>รายการเครื่องดื่ม</h2><br><br><br>
      <table border="0" width="100%" >
          <tr height ="60">
              <td width="5%"><h2>1</h2></td>
              <td width="70%"><h2>เสต๊คหมู</h2></td>
              <td width="15%"><h2>99</h2></td>
              <td width="10%"><h2>บาท</h2></td>
          <tr>
            <tr height ="60">
                <td width="5%"><h2>1</h2></td>
                <td width="70%"><h2>วาฟเฟิล กล้วย</h2></td>
                <td width="15%"><h2>99</h2></td>
                <td width="10%"><h2>บาท</h2></td>
            <tr>
              <tr height ="60">
                  <td width="5%"><h2>1</h2></td>
                  <td width="70%"><h2>วาฟเฟิล โกโก้</h2></td>
                  <td width="15%"><h2>99</h2></td>
                  <td width="10%"><h2>บาท</h2></td>
              <tr>
                <tr height ="60">
                    <td width="5%"><h2>1</h2></td>
                    <td width="70%"><h2>เฟร้นฟราย</h2></td>
                    <td width="15%"><h2>59</h2></td>
                    <td width="10%"><h2>บาท</h2></td>
                <tr>
                  <tr height ="60">
                      <td width="5%"><h2>1</h2></td>
                      <td width="70%"><h2>ปีกไก่ทอด</h2></td>
                      <td width="15%"><h2>69</h2></td>
                      <td width="10%"><h2>บาท</h2></td>
                  <tr>
      </table>
      <h4>รายการเครื่องดื่ม 14 รายการ</h4>
      <h4>ยอดสุทธิ 1,000 THB (บาท)</h4>
    </article>
  </section>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://html2canvas.hertzen.com/build/html2canvas.js"></script>
<script>
var baseURL = "<?php echo base_url(); ?>";
function downloadPDF($pdf_id){
	$("#"+$pdf_id).css({ opacity: 1 });
	html2canvas([document.getElementById($pdf_id)], {
		onrendered: function(canvas) {
		   var image = canvas.toDataURL('image/png');
		   SaveImage(image);
		}
	});
}
function SaveImage(image){
	$.ajax({
		type: 'POST',
		url: baseURL+'pdf/save',
		data: {base64Image:image,image_name:"pdf"},
		success: function(image) {
			var d = new Date();
			var n = d.getTime();
			window.location = image+"?t="+n;
		}
	});
}
$(document).ready(function(){
	setTimeout(init, 3000);
});
function init(){
	downloadPDF("pdf");
}
</script>
</body>
</html>
