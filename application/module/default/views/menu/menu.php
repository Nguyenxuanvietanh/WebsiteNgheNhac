<?php
    //$params == null
    $params['server']	= DB_HOST;
    $params['username']	= DB_USER;
    $params['password']	= DB_PASS;
    $params['database']	= DB_NAME;

    $conn = mysqli_connect($params['server'], $params['username'], $params['password'], $params['database']);
    mysqli_set_charset($conn,"utf8");
    if(!$conn){
        die('Fail connect: ' . mysqli_errno());
    }else{

        $arrTheloai = array();
        $queryTheloai = "SELECT `idtheloai`,`tentheloai` FROM `theloai`";
        $theloais = mysqli_query($conn, $queryTheloai);

        if(mysqli_num_rows($theloais) > 0){
            while($row = mysqli_fetch_assoc($theloais)){
                $arrTheloai[] = $row;
            }
            mysqli_free_result($theloais);
        }

        
        $arrChude = array();
        $queryChude = "SELECT `idchude`,`tenchude` FROM `chude`";
        $chudes = mysqli_query($conn, $queryChude);

        if(mysqli_num_rows($chudes) > 0){
            while($row = mysqli_fetch_assoc($chudes)){
                $arrChude[] = $row;
            }
            mysqli_free_result($chudes);
        }
        
        

        $arrQuocgia = array();
        $queryQuocgia = "SELECT `idquocgia`,`tenquocgia` FROM `quocgia`";
        $quocgias = mysqli_query($conn, $queryQuocgia);

        if(mysqli_num_rows($quocgias) > 0){
            while($row = mysqli_fetch_assoc($quocgias)){
                $arrQuocgia[] = $row;
            }
            mysqli_free_result($quocgias);
        }

    }
    mysqli_close($conn);


?>
<div class="menu">
    <ul class="content-menu">
        <div class="home">

        </div>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="#">Chủ Đề</a>
            <div class="sub-menu">
                <div class="menu-col-6">
                    <div class="title-sub-menu">Đề xuất</div>
                    <div class="clr"></div>
                    <ul>
                        <?php
                            foreach($arrChude as $chude){
                                $link = URL::createLink('default', 'song', 'listSong', array('idchude'=>$chude['idchude']));
                                echo '<li>
                                        <a href="'.$link.'">'.$chude['tenchude'].'</a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="menu-col-6">
                    <div class="title-sub-menu">Thể loại</div>
                    <div class="clr"></div>
                    <ul>
                        <?php
                            foreach($arrTheloai as $theloai){
                                $link = URL::createLink('default', 'song', 'listSong', array('idtheloai'=>$theloai['idtheloai']));
                                echo '<li>
                                        <a href="'.$link.'">'.$theloai['tentheloai'].'</a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </li>

        <li>
            <a href="#">Album</a>
            <div class="sub-menu">
                <div class="menu-col-6">
                    <div class="title-sub-menu">Đề xuất</div>
                    <div class="clr"></div>
                    <ul>
                        <?php
                            foreach($arrChude as $chude){
                                $link = URL::createLink('default', 'album', 'index', array('idchude'=>$chude['idchude']));
                                echo '<li>
                                        <a href="'.$link.'">'.$chude['tenchude'].'</a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="menu-col-6">
                    <div class="title-sub-menu">Thể loại</div>
                    <div class="clr"></div>
                    <ul>
                        <?php
                            foreach($arrTheloai as $theloai){
                                $link = URL::createLink('default', 'album', 'index', array('idtheloai'=>$theloai['idtheloai']));
                                echo '<li>
                                        <a href="'.$link.'">'.$theloai['tentheloai'].'</a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <a href="#">Video</a>
            <div class="sub-menu">
                <div class="menu-col-6">
                    <div class="title-sub-menu">Đề xuất</div>
                    <div class="clr"></div>
                    <ul>
                        <?php
                            foreach($arrChude as $chude){
                                $link = URL::createLink('default', 'mv', 'index', array('idchude'=>$chude['idchude']));
                                echo '<li>
                                        <a href="'.$link.'">'.$chude['tenchude'].'</a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="menu-col-6">
                    <div class="title-sub-menu">Thể loại</div>
                    <div class="clr"></div>
                    <ul>
                        <?php
                            foreach($arrTheloai as $theloai){
                                $link = URL::createLink('default', 'mv', 'index', array('idtheloai'=>$theloai['idtheloai']));
                                echo '<li>
                                        <a href="'.$link.'">'.$theloai['tentheloai'].'</a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <a href="#">Nghệ sỹ</a>
            <div class="sub-mn">
                <div class="menu-col">
                    <ul>
                        <?php
                            foreach($arrQuocgia as $quocgia){
                                $link = URL::createLink('default', 'singer', 'listSinger', array('idquocgia'=>$quocgia['idquocgia']));
                                echo '<li>
                                        <a href="'.$link.'">'.$quocgia['tenquocgia'].'</a>
                                    </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <a href="#">BXH</a>
        </li>
        <li>
            <a id="shop" href="#">Shop</a>
        </li>
    </ul>
</div>
<div class="clr"></div>