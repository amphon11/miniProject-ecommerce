<div class="navbar-fix">
  <header>
    <div class="container">
      <div class="nav-con">
        <div class="logo">
          <?php if(basename($_SERVER['PHP_SELF']) == 'order_list.php'):?>
            <a href="#"><img src="../img/icons8-workstation-gradient/icons8-workstation-64.png" alt=""></a>
            <?php else:?>
              <a href="#"><img src="./img/icons8-workstation-gradient/icons8-workstation-64.png" alt=""></a>
              <?php endif;?>
        </div>
        <div class="search">
          <form id="search_form" action="" method="POST" onsubmit="return valid_form()">
            <!-- <div class="dropdonw-search">
              <select name="" id="type_select"> -->
            <!-- <option value="">mouse</option>
                <option value="">keyboard</option>
                <option value="">headphone</option>
                <option value="">microphone</option> -->
            <!-- </select>
            </div> -->
            <input type="" placeholder="search here" name="search">
            <button id="btn_search">search</button>
          </form>

        </div>
        <div class="menu">
          <ul>
            <li class="li-cart">
              <i class="ri-shopping-cart-line" id="cart"></i>
              <span>cart</span>
              <span class="item-floating">0</span>
              <div class="cart">
                <div class="dropdown-cart">
                  <div class="wrap" id="cart-list">

                    <!-- items-list -->


                    <!-- /items-list -->
                  </div>
                  <div class="price">
                    <p id="quantity">ยังไม่มีสินค้าในตะกร้า</p>
                  </div>
                  <a class="view-cart" type="button" href="cart.php">view cart</a>
                </div>
              </div>
            </li>
            <li class="user">
              <i class="ri-user-3-fill"></i>
              <span><?php if (!empty($_SESSION)) {
                      echo $ss_username;
                    } else {
                      echo 'log in';
                    }
                    ?></span>
              <div class="dropdown">
                <div class="dropdown-content">
                  <div class="drop-list">
                    <?php if (empty($ss_username)) : ?>
                      <a href="./Login/Form_Login.php">เข้าสู่ระบบ</a>
                      <a href="Register/">สมัครสมาชิก</a>
                    <?php else : ?>
                      <?php if (basename($_SERVER['PHP_SELF']) == 'order_list.php') : ?>
                        <a href="../logout.php">ออกจากระบบ</a>

                      <?php elseif (basename($_SERVER['PHP_SELF']) == 'confirm_order.php') : ?>
                        <a href="../profile.php">หน้าหลัก</a>
                        <a href="../logout.php">ออกจากระบบ</a>
                      <?php elseif (basename($_SERVER['PHP_SELF']) == 'profile.php') : ?>
                        <a href="./logout.php">ออกจากระบบ</a>
                      <?php else : ?>
                        <a href="profile.php">ข้อมูลส่วนตัว</a>
                        <a href="./logout.php">ออกจากระบบ</a>
                      <?php endif ?>
                    <?php endif ?>
                  </div>

                </div>
              </div>
            </li>

          </ul>

        </div>
      </div>
    </div>
  </header>
  <div class="nav-menu">
    <div class="container">
      <ul>
        <!-- เมนูหน้าหลัก -->
        <li <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : ''; ?>>
          <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') : ?>
            <a href="#">หน้าหลัก</a>
          <?php elseif (basename($_SERVER['PHP_SELF']) == 'confirm_order.php') : ?>
            <a href="../index.php">หน้าหลัก</a>
          <?php elseif (basename($_SERVER['PHP_SELF']) == 'order_list.php') : ?>
            <a href="../index.php">หน้าหลัก</a>
          <?php else : ?>
            <a href="index.php">หน้าหลัก</a>
          <?php endif ?>
        </li>
        <!-- เมนูหน้าหลัก -->

        <!-- รายการคำสั่งซื้อ -->
        <?php if (!empty($ss_username)) : ?>
          <li <?php echo (basename($_SERVER['PHP_SELF']) == 'order_list.php') ? 'class="active"' : ''; ?>>
              <a href="./order/order_list.php">รายการคำสั่งซื้อ</a>
            </li>
        <?php endif; ?>

        <!-- รายการคำสั่งซื้อ -->
        <li <?php echo (basename($_SERVER['PHP_SELF']) == 'cart.php') ? 'class="active"' : ''; ?>>
          <?php if (basename($_SERVER['PHP_SELF']) == 'confirm_order.php') : ?>
            <a href="../cart.php">ตระกร้าสินค้า</a>
          <?php elseif (basename($_SERVER['PHP_SELF']) == 'order_list.php') : ?>
            <a href="../cart.php">ตระกร้าสินค้า</a>
          <?php else : ?>
            <a href="./cart.php">ตระกร้าสินค้า</a>
          <?php endif ?>
        </li>
      </ul>
    </div>

  </div>

</div>