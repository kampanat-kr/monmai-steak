
<html>
<?php
error_reporting (E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Bangkok');
$action_date = date("Y-m-d H:i:s");
$logout_date = date("Y-m-d");
$logout_time = date("H:i:s");
?>
<title>ใบเสร็จรับเงิน</title>
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.2.3/paper.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <style>@page { size: A4 Portrait }</style>
  <style>
    body   { font-family: Kanit; height:AUTO; }
	#pdf   { text-align:justify; height:AUTO; }
    h1     { font-family: 'Kanit', cursive; font-size: 40pt; line-height: 18mm; text-align:justify;}
    h2, h3 { font-family: 'Kanit', cursive; font-size: 20pt; line-height: 7mm; text-align:justify; }
    h4     { font-size: 32pt; line-height: 14mm }
    h2 + p { font-size: 18pt; line-height: 7mm }
    h3 + p { font-size: 14pt; line-height: 7mm }
    li     { font-size: 11pt; line-height: 5mm }
    h1      { margin: 0 }
    h1 + ul { margin: 2mm 0 5mm }
    h2, h3  { margin: 0 3mm 3mm 0; float: left }
    h2 + p,
    h3 + p  { margin: 0 0 3mm 50mm }
    h4      { margin: 2mm 0 0 50mm; border-bottom: 2px solid black }
    h4 + ul { margin: 5mm 0 0 50mm }
    article { border: 4px double black; padding: 5mm 10mm; border-radius: 3mm }
  </style>
</head>
<body class="A4 Portrait">
  <section class="sheet padding-20mm" id="pdf">
    <h2>ขนำไร่ ชายน้ำ  วันที่ <?php echo $logout_date;  ?> เวลา <?php echo $logout_time;  ?></h2>
    <br>
    <ul>
      <li>41/94 ถนนแจ้งวัฒนา ปากเกร็ด นนทบุรี 11120</li>
      <li>โทร. +66 085.900.3405</li>
    </ul>

    <article>
      <h2>โต๊ะ</h2>
      <p>1</p>
      <h2>รายการอาหาร</h2>
      <br>
      <ul>
        <li><h2>Tax: included</h2></li><br>
        <li><h2>Paid by: cash</h2></li><br>
        <li><h2>No. 00001</h2></li><br>
        <li><h2>Tax: included</h2></li><br>
        <li><h2>Oct 10, 2017</h2></li><br>
        <li><h2>Paid by: cash</h2></li><br>
        <li><h2>No. 00001</h2></li><br>
        <li><h2>Tax: included</h2></li><br>
        <li><h2>Paid by: cash</h2></li><br>
        <li><h2>No. 00001</h2></li><br>
        <li><h2>Tax: included</h2></li><br>
        <li><h2>Oct 10, 2017</h2></li><br>
        <li><h2>Paid by: cash</h2></li><br>
        <li><h2>No. 00001</h2></li><br>

      </ul>
      <h2>รวมเป็นเงินทั้งสิ้น 1,000 THB (บาท)</h2>
      <br>

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
