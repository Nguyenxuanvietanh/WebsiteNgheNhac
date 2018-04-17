<?php
    $singerInfo = $this->singerInfo;
?>
<div class="content">
    
    <div class="clr"></div>
    <div class="content-left">
        <!-- =========== Danh sách nhạc =========== -->
        <div class="casy">
            <h3 style="color: purple;">Thông Tin Ca Sỹ</h3>
            <div class="img-casy">
                <img src="public/images/singers/<?php echo $singerInfo['hinhanh']; ?>" alt="">
            </div>
            <div class="info-casy">
                <div>
                    <span>Tên ca sỹ: </span><b><?php echo $singerInfo['tencasy']; ?></b>
                </div>
                <div style="margin: 15px 0;">
                    <span>Lượt quan tâm: </span><?php echo $singerInfo['luotquantam']; ?>
                </div>
                <span>Info ca sỹ: </span><p><?php echo $singerInfo['infocasy']; ?></p>
            </div>
        </div>
        <div class="clr"></div>
        <!-- =========== Danh sách nhạc =========== -->
        <div class="list-nhac">
            <h3 class="title">LIST <?php echo $singerInfo['tencasy']; ?></h3>

            <div class="album">
                <?php
                    foreach($this->singerList as $song){
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
                ?>
            </div>
        </div>


        <!-- =========== Danh sách Album =========== -->
        <div class="list-nhac">
            <h3 class="title">ALBUM <?php echo $singerInfo['tencasy']; ?></h3>

            <div class="album">
                <?php
                    foreach($this->singerAlbum as $album){
                        $link = URL::createLink('default', 'album', 'album', array('idalbum'=>$album['idalbum']));
                        echo '<div class="album-item">
                                <div class="item-content">
                                    <a href="'.$link.'">
                                        <img src="public/images/albums/'.$album['hinhanh'].'" class="thumb" />
                                        <span class="icon-play"></span>
                                    </a>
                                    <div class="item-name">
                                        <a href="'.$link.'">'.$album['tenalbum'].'</a>
                                    </div>
                                    <div class="item-singer">
                                        <a href="#">'.$album['tencasy'].'</a>
                                    </div>
                                </div>
                            </div>';
                    }
                ?>
            </div>
        </div>

        <!-- =========== Danh sách MV =========== -->
        <div class="list-nhac">
            <h3 class="title">MV <?php echo $singerInfo['tencasy']; ?></h3>

            <div class="album">
                <?php
                    foreach($this->singerMV as $mv){
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
                ?>
            </div>
        </div>

    </div>

    <!--======================= Content-right======================= -->
    <div class="content-right">
        <div class="toppic-hot">
            <h3 class="title">Ca sỹ khác
                <i class="icon-arrow"></i>
            </h3>
            <div class="chude">
                <ul>
                    <?php
                        foreach($this->singerSuggest as $singer){
                            $link = URL::createLink('default', 'singer', 'singer', array('idcasy'=>$singer['idcasy']));
                            echo '<li>
                                    <a href="'.$link.'">
                                        <img src="public/images/singers/'.$singer['hinhanh'].'" width="50" height="50" alt="">
                                    </a>
                                    <a href="'.$link.'">
                                        <h3 class="tenbh-goiy">'.$singer['tencasy'].'</h3>
                                    </a>
                                    <h4 class="tencasy-goiy">'.$singer['luotquantam'].' quan tâm</h4>
                                </li>';
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
        <div class="clr"></div>

    </div>

    <div class="clr"></div>
</div>