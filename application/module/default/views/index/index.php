<?php
$vnSongTopRate = $this->vnSongsRates[0];
$vnSongRates   = array_slice($this->vnSongsRates, 1);

$hqSongTopRate = $this->hqSongsRates[0];
$hqSongRates   = array_slice($this->hqSongsRates, 1);

$amSongTopRate = $this->amSongsRates[0];
$amSongRates   = array_slice($this->amSongsRates, 1);

$vnMvTopRate = $this->vnMvRates[0];
$vnMvRates   = array_slice($this->vnMvRates, 1);

$hqMvTopRate = $this->hqMvRates[0];
$hqMvRates   = array_slice($this->hqMvRates, 1);

$amMvTopRate = $this->amMvRates[0];
$amMvRates   = array_slice($this->amMvRates, 1);


?>
<div class="content">
    <div class="content-left">
        <div class="slide-show">
            <div class="slide">
                <img src="" alt="" stt="0">
            </div>
            <div class="button" style="display: none">
                <a id="next" href="#">Next</a>
                <a id="prev" href="#">Prev</a>
            </div>
            <div class="small-image">
                <ul>
                    <li id="img1"><img src="public/template/default/main/images/baoanh.jpg" index="0" class="active" alt=""></li>
                    <li id="img2"><img src="public/template/default/main/images/slide2.jpg" index="1" alt=""></li>
                    <li id="img3"><img src="public/template/default/main/images/chidan.jpg" index="2" alt=""></li>
                    <li id="img4"><img src="public/template/default/main/images/slide3.jpg" index="3" alt=""></li>
                    <li id="img5"><img src="public/template/default/main/images/slide4.jpg" index="4" alt=""></li>
                </ul>
            </div>
        </div>

        <!-- =========== Danh sách nhạc =========== -->
        <div class="list-nhac">
            <h5 class="title">DANH SÁCH NHẠC</h5>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->songs as $song){
                        $linknhac = URL::createLink('default', 'song', 'song', array('idbaihat' => $song['idbaihat']));
                        echo '
                            <div class="album-item">
                                <div class="item-content">
                                    <a href="'.$linknhac.'">
                                        <img src="public/images/songs/'.$song['hinhanh'].'" class="thumb" />
                                        <span class="icon-play"></span>
                                    </a>
                                    <div class="item-name">
                                        <a href="'.$linknhac.'">'.$song['tenbh'].'</a>
                                    </div>
                                    <div class="item-singer">
                                        <a href="#">'.$song['tencasy'].'</a>
                                    </div>
                                </div>
                            </div>
                            ';
                    }
                ?>
                
            </div>
        </div>

        <!-- =========== Album HOT =========== -->
        <div class="album-hot">
            <h2 class="title">DANH SÁCH ALBUM</h2>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->albums as $album){
                        $linkAlbum = URL::createLink('default', 'album', 'album', array('idalbum'=>$album['idalbum']));
                        echo '
                        <div class="album-item">
                            <div class="item-content">
                                <a href="'.$linkAlbum.'">
                                    <img src="public/images/albums/'.$album['hinhanh'].'" class="thumb" />
                                    <span class="icon-play"></span>
                                </a>
                                <div class="item-name">
                                    <a href="'.$linkAlbum.'">'.$album['tenalbum'].'</a>
                                </div>
                                <div class="item-singer">
                                    <a href="#">'.$album['tencasy'].'</a>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>
            </div>
        </div>

        <!-- =========== Video HOT =========== -->
        <div class="video-hot">
            <h2 class="title">DANH SÁCH VIDEO</h2>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->videos as $video){
                        $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$video['idmv']));
                        echo '
                            <div class="album-item">
                                <div class="item-content">
                                    <a href="'.$link.'">
                                        <img src="public/images/mv/'.$video['hinhanh'].'" class="thumb" />
                                        <span class="icon-play"></span>
                                    </a>
                                    <div class="item-name">
                                        <a href="'.$link.'">'.$video['tenbh'].'</a>
                                    </div>
                                    <div class="item-singer">
                                        <a href="#">'.$video['tencasy'].'</a>
                                    </div>
                                </div>
                            </div>
                            ';
                    }
                ?>
            </div>
        </div>

        <!-- =========== Nhạc Việt =========== -->
        <div class="album">
            <div class="nhacvietmoi col-6">
                <h2 class="title-nhac">Nhạc Việt Mới
                    <i class="icon-arrow"></i>
                </h2>
                <ul>
                    <?php
                        foreach($this->newSongs as $newSong){
                            $link = URL::createLink('default', 'song', 'song', array('idbaihat' => $newSong['idbaihat']));
                            echo '
                            <li>
                                <img src="public/images/songs/'.$newSong['hinhanh'].'" width="50" />
                                <h3 class="txt-primary">
                                    <a href="'.$link.'">'.$newSong['tenbh'].'</a>
                                </h3>
                                <span class="inblock">
                                    <h4><a href="#">'.$newSong['tencasy'].'</a></h4>
                                </span>
                                <div class="tool-icon">
                                    <div class="i25 download">
                                        <a href="'.PUBLIC_URL . 'mp3/' . $newSong['mp3'].'" title="Download" download></a>
                                    </div>
                                    <div class="i25 addlist">
                                        <a href="#" title="Addlist"></a>
                                    </div>
                                    <div class="i25 share">
                                        <a href="#" title="Share"></a>
                                    </div>
                                </div>
                            </li>
                            ';
                        }
                    ?>
                </ul>
            </div>

            <div class="nhacvietmoi col-offset-6 col-6">
                <h2 class="title-nhac">Nhạc Việt HOT
                    <i class="icon-arrow"></i>
                </h2>
                <ul>
                    <?php
                        foreach($this->hotSongs as $hotSong){
                            $link = URL::createLink('default', 'song', 'song', array('idbaihat' => $hotSong['idbaihat']));
                            echo '
                            <li>
                                <img src="public/images/songs/'.$hotSong['hinhanh'].'" width="50" />
                                <h3 class="txt-primary">
                                    <a href="'.$link.'">'.$hotSong['tenbh'].'</a>
                                </h3>
                                <span class="inblock">
                                    <h4><a href="#">'.$hotSong['tencasy'].'</a></h4>
                                </span>
                                <div class="tool-icon">
                                    <div class="i25 download">
                                        <a href="'.PUBLIC_URL . 'mp3/' . $hotSong['mp3'].'" title="Download" download></a>
                                    </div>
                                    <div class="i25 addlist">
                                        <a href="#" title="Addlist"></a>
                                    </div>
                                    <div class="i25 share">
                                        <a href="#" title="Share"></a>
                                    </div>
                                </div>
                            </li>
                            ';
                        }
                    ?>
                </ul>
            </div>

        </div>

        <div class="nghesyhot">
            <h2 class="title-singer">Nghệ sỹ Hot
                <i class="icon-arrow"></i>
            </h2>
            <ul class="list-singer">
                <?php
                    foreach($this->hotSingers as $hotSinger){
                        echo '<li>
                                <a href="#">
                                    <img src="public/images/singers/'.$hotSinger['hinhanh'].'" />
                                    <div class="tencasy">
                                        <span>'.$hotSinger['tencasy'].'</span>
                                    </div>
                                </a>
                            </li>';
                    }
                ?>
            </ul>
        </div>
    </div>

<!--======================= Content-right======================= -->
    <div class="content-right">
        <div class="toppic-hot">
            <ul>
                <?php
                    foreach($this->topics as $topic){
                        echo '<li>
                                <a class="topic" href="#">
                                    <img src="public/images/topics/'.$topic['hinhanh'].'" alt="">
                                </a>
                            </li>';
                    }
                ?>
            </ul>
            <a href="#" class="more">Xem thêm Chủ Đề khác >>
            </a>
        </div>
        <div class="clr"></div>
        <!-- =================Bảng xếp hạng Bài hát=============== -->
        <div class="bangxephang">
            <span class="title-bxh">
                <a href="#">Bxh Bài Hát</a>
                <i class="icon-arrow"></i>
            </span>
            <ul class="tab-nav">
                <li>
                    <a id="bhvn">Việt Nam</a>
                </li>
                <li>
                    <a id="bham">Âu Mỹ</a>
                </li>
                <li>
                    <a id="bhhq">Hàn Quốc</a>
                </li>
            </ul>
            <div class="chart-bxh">
                <ul id="listvn" class="list-bxh">
                    <?php
                        $link = URL::createLink('default', 'song', 'song', array('idbaihat'=>$vnSongTopRate['idbaihat']));
                        echo '<li>
                                <a href="'.$link.'">
                                    <img src="public/images/songs/chitiet/'.$vnSongTopRate['img-chitiet'].'" alt="">
                                </a>
                                <div class="info-bxh-top">
                                    <span class="rank">01</span>
                                    <div class="tenbh-bxh-top">
                                        <a href="'.$link.'">'.$vnSongTopRate['tenbh'].'</a>
                                    </div>
                                    <div class="casy-bxh">
                                        <a class="tencasy-bxh-top" href="#">'.$vnSongTopRate['tencasy'].'</a>
                                        <span id="luotnghe-bxh">'. number_format($vnSongTopRate['luotnghe']).'</span>
                                        <div class="tool-icon">
                                            <div class="i25 download">
                                                <a href="'.PUBLIC_URL . 'mp3/' . $vnSongTopRate['mp3'].'" title="Download" download></a>
                                            </div>
                                            <div class="i25 addlist">
                                                <a href="#" title="Addlist"></a>
                                            </div>
                                            <div class="i25 share">
                                                <a href="#" title="Share"></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>';
                            $i = 2;
                            foreach($vnSongRates as $vnSongRate){
                                $link = URL::createLink('default', 'song', 'song', array('idbaihat'=>$vnSongRate['idbaihat']));
                                echo '<li>
                                        <div class="info-bxh">
                                            <span class="rank">0'.$i.'</span>
                                            <div class="tenbh-bxh">
                                                <a href="'.$link.'">'.$vnSongRate['tenbh'].'</a>
                                            </div>
                                            <div class="casy-bxh">
                                                <a class="tencasy-bxh" href="#">'.$vnSongRate['tencasy'].'</a>
                                                <span id="luotnghe-bxh">'.number_format($vnSongRate['luotnghe']).'</span>
                                                <div class="tool-icon">
                                                    <div class="i25 download">
                                                        <a href="'.PUBLIC_URL . 'mp3/' . $vnSongRate['mp3'].'" title="Download" download></a>
                                                    </div>
                                                    <div class="i25 addlist">
                                                        <a href="#" title="Addlist"></a>
                                                    </div>
                                                    <div class="i25 share">
                                                        <a href="#" title="Share"></a>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div>
                                    </li>';
                                    $i++;
                            }
                    ?>
                </ul>

                <ul id="listam" class="list-bxh">
                    <?php
                        $link = URL::createLink('default', 'song', 'song', array('idbaihat'=>$amSongTopRate['idbaihat']));
                        echo '<li>
                                <a href="'.$link.'">
                                    <img src="public/images/songs/chitiet/'.$amSongTopRate['img-chitiet'].'" alt="">
                                </a>
                                <div class="info-bxh-top">
                                    <span class="rank">01</span>
                                    <div class="tenbh-bxh-top">
                                        <a href="'.$link.'">'.$amSongTopRate['tenbh'].'</a>
                                    </div>
                                    <div class="casy-bxh">
                                        <a class="tencasy-bxh-top" href="#">'.$amSongTopRate['tencasy'].'</a>
                                        <span id="luotnghe-bxh">'.number_format($amSongTopRate['luotnghe']).'</span>
                                        <div class="tool-icon">
                                            <div class="i25 download">
                                                <a href="'.PUBLIC_URL . 'mp3/' . $amSongTopRate['mp3'].'" title="Download" download></a>
                                            </div>
                                            <div class="i25 addlist">
                                                <a href="#" title="Addlist"></a>
                                            </div>
                                            <div class="i25 share">
                                                <a href="#" title="Share"></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>';
                            $i = 2;
                            foreach($amSongRates as $amSongRate){
                                $link = URL::createLink('default', 'song', 'song', array('idbaihat'=>$amSongRate['idbaihat']));
                                echo '<li>
                                        <div class="info-bxh">
                                            <span class="rank">0'.$i.'</span>
                                            <div class="tenbh-bxh">
                                                <a href="'.$link.'">'.$amSongRate['tenbh'].'</a>
                                            </div>
                                            <div class="casy-bxh">
                                                <a class="tencasy-bxh" href="#">'.$amSongRate['tencasy'].'</a>
                                                <span id="luotnghe-bxh">'.number_format($amSongRate['luotnghe']).'</span>
                                                <div class="tool-icon">
                                                    <div class="i25 download">
                                                        <a href="'.PUBLIC_URL . 'mp3/' . $amSongRate['mp3'].'" title="Download" download></a>
                                                    </div>
                                                    <div class="i25 addlist">
                                                        <a href="#" title="Addlist"></a>
                                                    </div>
                                                    <div class="i25 share">
                                                        <a href="#" title="Share"></a>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div>
                                    </li>';
                                    $i++;
                            }
                    ?>
                </ul>

                <ul id="listhq" class="list-bxh">
                    <?php
                        $link = URL::createLink('default', 'song', 'song', array('idbaihat'=>$hqSongTopRate['idbaihat']));
                        echo '<li>
                                <a href="'.$link.'">
                                    <img src="public/images/songs/chitiet/'.$hqSongTopRate['img-chitiet'].'" alt="">
                                </a>
                                <div class="info-bxh-top">
                                    <span class="rank">01</span>
                                    <div class="tenbh-bxh-top">
                                        <a href="'.$link.'">'.$hqSongTopRate['tenbh'].'</a>
                                    </div>
                                    <div class="casy-bxh">
                                        <a class="tencasy-bxh-top" href="#">'.$hqSongTopRate['tencasy'].'</a>
                                        <span id="luotnghe-bxh">'.number_format($hqSongTopRate['luotnghe']).'</span>
                                        <div class="tool-icon">
                                            <div class="i25 download">
                                                <a href="'.PUBLIC_URL . 'mp3/' . $hqSongTopRate['mp3'].'" title="Download" download></a>
                                            </div>
                                            <div class="i25 addlist">
                                                <a href="#" title="Addlist"></a>
                                            </div>
                                            <div class="i25 share">
                                                <a href="#" title="Share"></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>';
                            $i = 2;
                            foreach($hqSongRates as $hqSongRate){
                                $link = URL::createLink('default', 'song', 'song', array('idbaihat'=>$hqSongRate['idbaihat']));
                                echo '<li>
                                        <div class="info-bxh">
                                            <span class="rank">0'.$i.'</span>
                                            <div class="tenbh-bxh">
                                                <a href="'.$link.'">'.$hqSongRate['tenbh'].'</a>
                                            </div>
                                            <div class="casy-bxh">
                                                <a class="tencasy-bxh" href="#">'.$hqSongRate['tencasy'].'</a>
                                                <span id="luotnghe-bxh">'.number_format($hqSongRate['luotnghe']).'</span>
                                                <div class="tool-icon">
                                                    <div class="i25 download">
                                                        <a href="'.PUBLIC_URL . 'mp3/' . $vnSongRate['mp3'].'" title="Download" download></a>
                                                    </div>
                                                    <div class="i25 addlist">
                                                        <a href="#" title="Addlist"></a>
                                                    </div>
                                                    <div class="i25 share">
                                                        <a href="#" title="Share"></a>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div>
                                    </li>';
                                    $i++;
                            }
                    ?>
                </ul>
            </div>
        </div>

        <!-- =================Bảng xếp hạng Video=============== -->
        <div class="bangxephang">
            <span class="title-bxh">
                    <a href="#">Bxh Video</a>
                    <i class="icon-arrow"></i>
                </span>
            <ul class="tab-nav">
                <li>
                    <a id="vdvn">Việt Nam</a>
                </li>
                <li>
                    <a id="vdam">Âu Mỹ</a>
                </li>
                <li>
                    <a id="vdhq">Hàn Quốc</a>
                </li>
            </ul>
            <div class="chart-bxh">
                <ul id="listvd-vn" class="list-bxh">
                    <?php
                        $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$vnMvTopRate['idmv']));
                        echo '<li>
                                <a href="'.$link.'">
                                    <img src="public/images/songs/chitiet/'.$vnMvTopRate['img-chitiet'].'" alt="">
                                </a>
                                <div class="info-bxh-top">
                                    <span class="rank">01</span>
                                    <div class="tenbh-bxh-top">
                                        <a href="'.$link.'">'.$vnMvTopRate['tenbh'].'</a>
                                    </div>
                                    <div class="casy-bxh">
                                        <a class="tencasy-bxh-top" href="#">'.$vnMvTopRate['tencasy'].'</a>
                                        <span id="luotnghe-bxh">'.number_format($vnMvTopRate['luotxem']).'</span>
                                        <div class="tool-icon">
                                            <div class="i25 download">
                                                <a href="'.PUBLIC_URL . 'mvs/' . $vnMvTopRate['linkvideo'] .'" title="Download" download></a>
                                            </div>
                                            <div class="i25 addlist">
                                                <a href="#" title="Addlist"></a>
                                            </div>
                                            <div class="i25 share">
                                                <a href="#" title="Share"></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>';
                            $i = 2;
                            foreach($vnMvRates as $vnMvRate){
                                $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$vnMvRate['idmv']));
                                echo '<li>
                                        <div class="info-bxh">
                                            <span class="rank">0'.$i.'</span>
                                            <div class="tenbh-bxh">
                                                <a href="'.$link.'">'.$vnMvRate['tenbh'].'</a>
                                            </div>
                                            <div class="casy-bxh">
                                                <a class="tencasy-bxh" href="#">'.$vnMvRate['tencasy'].'</a>
                                                <span id="luotnghe-bxh">'.number_format($vnMvRate['luotxem']).'</span>
                                                <div class="tool-icon">
                                                    <div class="i25 download">
                                                        <a href="'.PUBLIC_URL . 'mvs/' . $vnMvRate['linkvideo'] .'" title="Download" download></a>
                                                    </div>
                                                    <div class="i25 addlist">
                                                        <a href="#" title="Addlist"></a>
                                                    </div>
                                                    <div class="i25 share">
                                                        <a href="#" title="Share"></a>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div>
                                    </li>';
                                    $i++;
                            }
                    ?>
                </ul>

                <ul id="listvd-am" class="list-bxh">
                    <?php
                        $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$amMvTopRate['idmv']));
                        echo '<li>
                                <a href="'.$link.'">
                                    <img src="public/images/songs/chitiet/'.$amMvTopRate['img-chitiet'].'" alt="">
                                </a>
                                <div class="info-bxh-top">
                                    <span class="rank">01</span>
                                    <div class="tenbh-bxh-top">
                                        <a href="'.$link.'>'.$amMvTopRate['tenbh'].'</a>
                                    </div>
                                    <div class="casy-bxh">
                                        <a class="tencasy-bxh-top" href="#">'.$amMvTopRate['tencasy'].'</a>
                                        <span id="luotnghe-bxh">'.number_format($amMvTopRate['luotxem']).'</span>
                                        <div class="tool-icon">
                                            <div class="i25 download">
                                                <a href="'.PUBLIC_URL . 'mvs/' . $amMvTopRate['linkvideo'] .'" title="Download" download></a>
                                            </div>
                                            <div class="i25 addlist">
                                                <a href="#" title="Addlist"></a>
                                            </div>
                                            <div class="i25 share">
                                                <a href="#" title="Share"></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>';
                            $i = 2;
                            foreach($amMvRates as $amMvRate){
                                $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$amMvRate['idmv']));
                                echo '<li>
                                        <div class="info-bxh">
                                            <span class="rank">0'.$i.'</span>
                                            <div class="tenbh-bxh">
                                                <a href="'.$link.'">'.$amMvRate['tenbh'].'</a>
                                            </div>
                                            <div class="casy-bxh">
                                                <a class="tencasy-bxh" href="#">'.$amMvRate['tencasy'].'</a>
                                                <span id="luotnghe-bxh">'.number_format($amMvRate['luotxem']).'</span>
                                                <div class="tool-icon">
                                                    <div class="i25 download">
                                                        <a href="'.PUBLIC_URL . 'mvs/' . $amMvRate['linkvideo'] .'" title="Download" download></a>
                                                    </div>
                                                    <div class="i25 addlist">
                                                        <a href="#" title="Addlist"></a>
                                                    </div>
                                                    <div class="i25 share">
                                                        <a href="#" title="Share"></a>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div>
                                    </li>';
                                $i++;
                            }
                    ?>
                </ul>

                <ul id="listvd-hq" class="list-bxh">
                    <?php
                        $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$hqMvTopRate['idmv']));
                        echo '<li>
                                <a href="'.$link.'">
                                    <img src="public/images/songs/chitiet/'.$hqMvTopRate['img-chitiet'].'" alt="">
                                </a>
                                <div class="info-bxh-top">
                                    <span class="rank">01</span>
                                    <div class="tenbh-bxh-top">
                                        <a href="'.$link.'">'.$hqMvTopRate['tenbh'].'</a>
                                    </div>
                                    <div class="casy-bxh">
                                        <a class="tencasy-bxh-top" href="#">'.$hqMvTopRate['tencasy'].'</a>
                                        <span id="luotnghe-bxh">'.number_format($hqMvTopRate['luotxem']).'</span>
                                        <div class="tool-icon">
                                            <div class="i25 download">
                                                <a href="'.PUBLIC_URL . 'mvs/' . $hqMvTopRate['linkvideo'] .'" title="Download" download></a>
                                            </div>
                                            <div class="i25 addlist">
                                                <a href="#" title="Addlist"></a>
                                            </div>
                                            <div class="i25 share">
                                                <a href="#" title="Share"></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>';
                            $i = 2;
                            foreach($hqMvRates as $hqMvRate){
                                $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$hqMvRate['idmv']));
                                echo '<li>
                                        <div class="info-bxh">
                                            <span class="rank">0'.$i.'</span>
                                            <div class="tenbh-bxh">
                                                <a href="'.$link.'">'.$hqMvRate['tenbh'].'</a>
                                            </div>
                                            <div class="casy-bxh">
                                                <a class="tencasy-bxh" href="#">'.$hqMvRate['tencasy'].'</a>
                                                <span id="luotnghe-bxh">'.number_format($hqMvRate['luotxem']).'</span>
                                                <div class="tool-icon">
                                                    <div class="i25 download">
                                                        <a href="'.PUBLIC_URL . 'mvs/' . $hqMvRate['linkvideo'] .'" title="Download" download></a>
                                                    </div>
                                                    <div class="i25 addlist">
                                                        <a href="#" title="Addlist"></a>
                                                    </div>
                                                    <div class="i25 share">
                                                        <a href="#" title="Share"></a>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div>
                                    </li>';
                                $i++;
                            }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="clr"></div>
</div>
