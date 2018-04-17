<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <?php echo $this->_cssFiles;?>
</head>
<body>
<div data-vide-bg="video/video2">
    <div class="center-container">
        <!--header-->
        <div class="header-w3l">
            <h1>LeeO Music</h1>
        </div>
        <!--//header-->
        <!--main-->
        <div class="main-content-agile">
            <div class="wthree-pro">
                <h2>Login Admin</h2>
            </div>
            <div class="sub-main-w3">	
                <form action="index.php?module=admin&controller=index&action=login" method="post">
                    
                    <div class="icon1">
                        <i>UserName</i>
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
                    <input type="submit" name="submit" value="Sign in">
                    <h6>or đăng nhập với</h6>
                    <div class="navbar-right social-icons"> 
                        <a href="#" class="one-w3ls" >Facebook</a>
                        <a href="#" class="two-w3ls" >Google+</a>
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
            <p>Nếu bạn chưa có tài khoản. Hãy đăng ký <a href="#">tại đây !!!</a> </p>
        </div>
        <!--//main-->
        <div class="footer">
        </div>
    </div>
</div>
</body>
</html>

