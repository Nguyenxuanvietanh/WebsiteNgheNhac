<?php
    $this->errors = (isset($this->errors)) ? $this->errors : '';
    $message = Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);
?>
<div data-vide-bg="video/video2">
        <div class="center-container">
            <div class="main-content-agile">
                <div class="wthree-pro">
                    <h2>Register</h2>
                </div>
                <div class="sub-main-w3">
                <?php echo $this->errors; echo $strMessage; ?>
                    <form action="index.php?module=default&controller=user&action=register" method="post" enctype="multipart/form-data">

                        <div class="icon1">
                            <i></i>
                            <input placeholder="UserName " name="form[username]" type="text" required>
                        </div>

                        <div class="icon2">
                            <i></i>
                            <input placeholder="Password " name="form[password]" type="password" required>
                        </div>
                        <div class="icon2">
                            <i></i>
                            <input placeholder="Xác nhận password " name="form[re-password]" type="password" required>
                        </div>
                        <div class="icon1">
                            <i></i>
                            <input placeholder="Email " name="form[email]" type="email" required>
                        </div>
                        <div class="icon2">
                            <i></i>
                            <input placeholder="Tên " name="form[name]" type="text" required>
                        </div>

                        <div class="icon2">
                            <i></i>
                            <input placeholder="Số điện thoại " name="form[phone]" type="tel" required>
                        </div>
                        <div class="icon2">
                            <span>Ảnh đại diện</span>
                            <input type="file" name="form[image]" id="fileToUpload" required>
                        </div>
                        <br /><br />
                        <input type="submit" name="submit" value="Đăng ký">
                    </form>
                </div>
            </div>
            <!--//main-->
            <div class="footer">
            </div>
        </div>
    </div>