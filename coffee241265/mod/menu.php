      <?php
        $index = $_REQUEST['index'];
        switch ($index) {
          case '1':
              $active1 = 'active';
            break;
          case '2':
              $active2 = 'active';
            break;
          case '3':
              $active3 = 'active';
            break;
          case '4':
              $active4 = 'active';
            break;
          default:
            $active1 = 'active';
            break;
        }

      ?>

      <div class="navbar navbar-expand-lg bg-light navbar-light">
          <div class="container-fluid">
              <a href="index.php" class="navbar-brand">ขนำไร่ <span>ชายน้ำ</span></a>
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                  <div class="navbar-nav ml-auto">
                    <?php
                      if($firstname !=''){ ?>
                      <a href="#" class="nav-item nav-link ">ยินดีต้อนรับคุณ <?=$firstname?></a>
                    <?php } ?>
                      <a href="index.php?index=1" class="nav-item nav-link <?= $active1 ?>">หน้าหลัก</a>
                      <a href="about.php?index=2" class="nav-item nav-link <?= $active2 ?>">รายการที่สั่ง</a>
                      <?php
                        if($firstname==''){ ?>
                          <a href="mod_login/login.php" class="nav-item nav-link <?= $active3 ?>">เข้าสู่ระบบ</a>
                      <?php }else{ ?>
                        <a href="bookorder.php?index=3" class="nav-item nav-link <?= $active3 ?>">เพิ่มเมนูอาหาร</a>
                        <a href="about.php?index=4" class="nav-item nav-link <?= $active4 ?>">สรุปยอดจำหน่าย</a>
                        <a href="mod_login/login.php?action=login&LogId=<?=$LogId;?>" class="nav-item nav-link">ออกจากระบบ</a>
                      <?php } ?>

                  </div>
              </div>
          </div>
      </div>
