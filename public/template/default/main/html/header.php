
    <div class="header">
        <div class="content-header">
            <div class="logo">
                <img src="public/template/default/main/images/logo.png" height="40" alt="">
            </div>
            <div class="search">
                <form action="">
                    <input type="text" class="input-txt" placeholder="Nhập nội dung cần tìm" />
                    <span class="input-btn">
                    <button class="btn-search"></button>
                </span>
                </form>
            </div>

            <ul class="mn-header">
                <li><a href="#">mp3</a></li>
                <li><a href="#">news</a></li>
                <li><a href="#">tv</a></li>
            </ul>

            <div class="login">
            <?php
                if(Session::get('loggedIn')==true){
                    $user = Session::get('user');
                    echo '<span class="name" >Xin chào: <a href="index.php?controller=user&action=info&iduser='. $user['iduser'] .'">' . $user['name'] . '</a></span>';
                }else{
                    echo '<a href="index.php?controller=user&action=login">Đăng Nhập</a>';
                }
            ?>
            </div>
        </div>
    </div>
    <div class="clr"></div>
