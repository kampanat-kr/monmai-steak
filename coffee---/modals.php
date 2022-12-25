
<?php
    $name = $_POST['name'];
    $description = $_POST['description'];
    $order1 = $_POST['order1'];
?>

<script>
    function cal() {
        var number1 = document.getElementById("number3");
        var number2 = document.getElementById("number2");
        var result = document.getElementById("result");
        var s = parseInt(number1.value) - parseInt(number2.value);
        //result.innerHTML = s;
        document.form1.number4.value=s;
    }
</script>

<script language="javascript">
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<form name="form1" class="form-horizontal" action="index.php" method="post">
<div id="modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-ng">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title " id="myModalLabel2">ชำระเงิน</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

          </div>
          <div class="modal-body" >
              <div class="row p-l-20 p-r-10">
      					<div class="col-sm-12 col-md-12 col-lg-12 form-group">
                              <!-- แสดงผลตัวแปร name -->
                    <input type="input" name="var1" value="<?=$name;?>" class="form-control">
                </div>

      					<div class="col-sm-12 col-md-12 col-lg-12">
      						<label class="">จำนวนเงินทั้งสิ้น :</label>
                </div>
                          <!-- แสดงผลตัวแปร description -->
      					<div class="col-sm-12 col-md-12 col-lg-12 form-group">
                    <input type="input" name="var2" id="number2" value="<?=$description;?>" class="form-control">
      					</div>
              </div>

              <div class="row p-l-20 p-r-10">
      					<div class="col-sm-12 col-md-12 col-lg-12">
      						<label class="">เงินที่ชำระ :</label>
                </div>
                          <!-- แสดงผลตัวแปร description -->
      					<div class="col-sm-12 col-md-12 col-lg-12 form-group">
                    <input type="input" name="var3" id="number3" value="" class="form-control" onkeypress="return isNumberKey(event)" onkeyup="JavaScript:cal();" autocomplete="Off" required>
      					</div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                  <label class="">เงินทอน :</label>
                </div>
                          <!-- แสดงผลตัวแปร description -->
                <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                    <input type="input" name="var4" id="number4" value="" class="form-control">
                </div>
              </div>
              <input type="hidden" name="order1"  value="<?=$order1;?>" class="form-control">
          </div>

          <div class="modal-footer">
             <input name="cmdsave" type="hidden" value="Regiter_P" />
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-info">บันทึก</button>
          </div>

      </div>
    </div>
  </div>
</form>
