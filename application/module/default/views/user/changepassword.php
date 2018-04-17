
<div data-vide-bg="video/video2">
  <div class="center-container">
    <!--header-->
    <!--//header-->
    <!--main-->
    <div class="main-content-agile">
      <div class="wthree-pro">
        <h2>Change Password</h2>
      </div>
      <div class="sub-main-w3">	
        <form action="#" method="post">
          <?php
            echo $errors = !empty($this->errors) ? $this->errors : '';
          ?>
          <div class="icon2">
            <i>UserName</i>
            <input style="color: red; font-style: italic;"  value="<?php echo $this->dataUser['username']; ?>" name="username" type="text" readonly>
          </div>
          <div class="icon2">
            <i>Password</i>
            <input placeholder=" " name="form[password]" type="password" required>
          </div>
          <div class="icon2">
            <i>New password</i>
            <input placeholder=" " name="form[new-password]" type="text" required>
          </div>
          <div class="icon2">
            <i>Confirm new password</i>
            <input placeholder=" " name="form[confirm-password]" type="text" required>
          </div>
          <div class="rem-w3">
            <div class="clear"></div>
          </div>
          <br /><br />
          <input type="submit" name="submit" value="Change PassWord">
    </div>
  </div>
</div>

