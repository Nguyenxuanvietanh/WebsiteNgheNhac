<?php
  //MESSAGE
  $message = Session::get('message');
  Session::delete('message');
  $strMessage = Helper::cmsMessage($message);
?>
<div data-vide-bg="video/video2">
  <div class="center-container">
    <!--header-->
    <!--//header-->
    <!--main-->
    <div class="main-content-agile">
      <div class="wthree-pro">
        <h2>Login</h2>
      </div>
      <div class="sub-main-w3">	
        <form action="index.php?module=default&controller=user&action=login" method="post">
          <?php
            echo $errors = !empty($this->errors) ? $this->errors : '';
            echo $strMessage = !empty($strMessage) ? $strMessage : '';
          ?>
          <div class="icon1">
            <i>Username</i>
            <input placeholder=" " name="username" type="text" required>
          </div>
          
          <div class="icon2">
            <i>Password</i>
            <input  placeholder=" " name="password" type="password" required>
          </div>
          <div class="rem-w3">
            <span class="check-w3"><input type="checkbox" />Remember Me</span>
            <a href="#" >Quên mật khẩu</a>
            <div class="clear"></div>
          </div>
          <br /><br />
          <input type="submit" name="submit" value="Sign in">
          <h6>or đăng nhập với</h6>
          <div class="navbar-right social-icons"> 
            <a href="#" class="one-w3ls" >Facebook</a>
            <a href="#" class="two-w3ls" >Google+</a>
            <div class="clear"></div>
          </div>
                </form>
            </div>
            <p>Nếu bạn chưa có tài khoản. Hãy đăng ký <a href="<?php echo URL::createLink('default', 'user', 'register'); ?>">tại đây !!!</a> </p>
    </div>
  </div>
</div>

