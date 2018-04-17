<?php
    // echo '<pre>';
    // print_r($user);
    // echo '</pre>';
    //MESSAGE
    $message = Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);

    $this->errors = (isset($this->errors)) ? $this->errors : '';
?>
<div class="content">
<div class="content-left">
    <h3>Thông Tin Cá Nhân</h3>
    <?php echo $strMessage . $this->errors; ?>
    <div class="info">
        <div class="col-3 img-info">
        
            <?php
                if(isset($user['hinhanh'])){
                    echo '<img src="public/images/users/'. $user['hinhanh'] .'" alt="">';
                }else{
                    echo '<img src="public/images/users/default.jpg" alt="">';
                }
            ?>
        </div>
        <form action="index.php?module=default&controller=user&action=info&iduser=<?php echo $user['iduser']?>" method="POST">
            <div class="info-chitiet">
                <div class="ct">
                    <span class="col-3">Tên:</span>
                    <span class="e-name">
                        <?php echo $user['name']; ?>
                    </span>
                </div>
                <div class="ct">
                    <span class="col-3">Tài khoản:</span>
                    <span class="username">
                        <?php echo $user['username']; ?>
                    </span>
                </div>
                <div class="ct">
                    <span class="col-3">Mật khẩu:</span>
                    <span class="password">********</span>
                    <a href="<?php echo URL::createLink('default', 'user', 'changePassword', array('iduser'=>$user['iduser'])); ?>" class="doi-mk">Đổi mật khẩu</a>
                </div>
                <div class="ct">
                    <span class="col-3">Email:</span>
                    <input class="email" name="email" type="text" value="<?php echo $user['email']; ?>">
                </div>
                <div class="ct">
                    <span class="col-3">Số điện thoại:</span>
                    <input class="phone" name="phone" type="tel" value="<?php echo $user['phone']; ?>">
                </div>
                
                <div class="ct">
                    <button name="btnUpdate" type="submit" class="btn btn-success">Cập Nhật</button>
                    <button type="button" class="btn btn-danger">
                        <a href="index.php?controller=user&action=logout">Đăng xuất</a>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Kho Nhạc -->
    <?php
        if(!empty($this->songCabinet)){
            echo '<div class="list-nhac">
                <h5 class="title">Kho nhạc cá nhân</h5>
                <p class="sub-title">Description</p>
        
                <div class="album">';
                        foreach($this->songCabinet as $song){
                            $link = URL::createLink('default', 'song', 'song', array('idbaihat'=>$song['idbaihat']));
                            echo '<div class="album-item">
                                    <div class="item-content">
                                        <a href="'.$link.'">
                                            <img src="public/images/songs/'.$song['hinhanh'].'" class="thumb" />
                                            <span class="icon-play"></span>
                                        </a>
                                        <div class="item-name">
                                            <a href="'.$link.'">'.$song['tenbh'].'</a>
                                        </div>
                                        <div class="item-singer">
                                            <a href="#">'.$song['tencasy'].'</a>
                                        </div>
                                    </div>
                                </div>';
                        }
            echo'</div></div>';
        }
    ?>

    <!-- Kho Video -->
    <?php
        if(!empty($this->mvCabinet)){
            echo '<div class="list-nhac">
                <h5 class="title">Kho video cá nhân</h5>
                <p class="sub-title">Description</p>
        
                <div class="album">';
                        foreach($this->mvCabinet as $mv){
                            $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$mv['idmv']));
                            echo '<div class="album-item">
                                    <div class="item-content">
                                        <a href="'.$link.'">
                                            <img src="public/images/mv/'.$mv['hinhanh'].'" class="thumb" />
                                            <span class="icon-play"></span>
                                        </a>
                                        <div class="item-name">
                                            <a href="'.$link.'">'.$mv['tenbh'].'</a>
                                        </div>
                                        <div class="item-singer">
                                            <a href="#">'.$mv['tencasy'].'</a>
                                        </div>
                                    </div>
                                </div>';
                        }
            echo'</div></div>';
        }
    ?>

</div>

<!--======================= Content-right======================= -->
<div class="content-right">
    <h2 class="title-section">Gợi ý</h2>
    <div class="list-goiy">
        <ul>
            <?php
                foreach($this->suggests as $suggest){
                    $link = URL::createLink('default', 'song', 'song', array('idbaihat'=>$suggest['idbaihat']));
                    echo '<li>
                            <a href="'.$link.'">
                                <img src="public/images/singers/'.$suggest['img-casy'].'" width="50" height="50" alt="">
                            </a> 
                            <a href="'.$link.'"><h3 class="tenbh-goiy">'.$suggest['tenbh'].'</h3></a>
                            <a href="#"><h4 class="tencasy-goiy">'.$suggest['tencasy'].'</h4></a>
                            
                            <div class="tool-icon">
                                <div class="i25 download">
                                    <a href="#" title="Download"></a>
                                </div>
                                <div class="i25 addlist">
                                    <a href="#" title="Addlist"></a>
                                </div>
                                <div class="i25 share">
                                    <a href="#" title="Share"></a>
                                </div>
                            </div>
                        </li>';
                }
            ?>
        </ul>
    </div>
</div>

<div class="clr"></div>
</div>