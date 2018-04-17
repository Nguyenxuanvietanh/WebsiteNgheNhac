<?php
    $suggests   = $this->suggests;
    $mv = $this->data;
?>
<div class="content">
    <div class="content-left">
        <div class="baihat">
            <div class="info-top-baihat">
                <span class="tenbaihat"><?php echo $mv['tenbh']; ?> - </span>
                <a class="casy-title" href="#"><?php echo $mv['tencasy']; ?></a>
                <div class="btn-like">
                    <a href="#" class="zlike">
                        <span class="zicon"></span>Thích
                    </a>
                    <span class="like-count">
                        <i></i>
                        <b></b>
                        <span class="fn-count"><?php echo $mv['luotthich']; ?></span>
                    </span>
                </div>
            </div>
            <!-- VIDEO PLAYER -->
            <div class="video-player" id="ideo-player">
                <div>
                    <video id="video-element" autoplay >
                        <source src="public/mvs/<?php echo $mv['linkvideo']; ?>" type="video/mp4">
                        <source src="public/mvs/<?php echo $mv['linkvideo']; ?>" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div id="control">
                    <progress id="progress-bar" value="0" min="0" max="100"></progress>
                    <div class="left">
                        <div>
                            <span id="play-pause-btn" class="pause"></span>
                        </div>
                        <div class="time">
                            <span id="timer">00:00</span>
                            <span>/</span>
                            <span id="length">00:00</span>
                        </div>
                    </div>
                    <div class="right">
                        
                        <img src="public/images/interface/sound_icon.png" alt="">
                        <input type="range" id="volume-bar" title="volume" min="0" max="1" step="0.1" value="1">
                        <span id="btn-fullscreen" class="fullscreen">
                            <img src="public/images/interface/full-screen.png" alt="">
                        </span>
                    </div>
                    
                </div>
            </div>

            <div class="clr"></div>
            <div class="info-song">
                <span>Album: </span>
                <h2>
                    <a href=""><?php echo $mv['tenalbum']; ?></a>
                </h2>
                <div class="clr"></div>
                <span>Thể loại: </span>
                <h2>
                    <a href=""><?php echo $mv['tentheloai']; ?></a>
                </h2>
            </div>

            <div class="button-group">
                <a href="#" id="btnAdd">
                    <i class="z-icon zicon-add"></i>
                    <span>Thêm vào</span>
                </a>
                <a href="<?php echo PUBLIC_URL . 'mvs/' . $mv['linkvideo']; ?>" id="btnDownload" download>
                    <i class="z-icon zicon-down"></i>
                    <span>Tải về</span>
                </a>
                <a href="#" id="btnReply">
                    <i class="z-icon zicon-rep"></i>
                    <span>Phản hồi</span>
                </a>
                <a href="#" id="btnShare">
                    <i class="z-icon zicon-share"></i>
                    <span>Chia sẻ</span>
                </a>
            </div>
            <div class="count-view">
                <b class="ico">lượt nghe</b>
                <span class="count-luotnghe"><?php echo $mv['luotxem']; ?></span>
            </div>
        </div>
        <div class="clr"></div>
        <!-- =========== Info =========== -->
        <div class="lyric">
            <div class="lyric-title">
                <label>Lời bài hát: </label>
                <s class="song-title"><?php echo $mv['tenbh']; ?></s>
            </div>
            <p class="lyric-content" data-min="300px" data-max="auto">
                <?php echo '<textarea class="lyrics" disabled>'.$mv['lyrics'].'</textarea> '; ?>
            </p>
        </div>

        <div class="box-casy">
            <a href="#" class="img-casy">
                <img src="public/images/singers/<?php echo $mv['img-casy']; ?>" alt="" width="110" height="110">
            </a>
            <div class="info-casy">
                <h2>
                    <a href="#"><?php echo $mv['tencasy']; ?></a>
                </h2>
                <div class="subcribe">
                    <a href="#">
                        <span></span>
                        Quan tâm
                    </a>
                    <span class="like-count">
                        <i></i>
                        <b></b>
                        <span class="fn-count"><?php echo $mv['luotquantam']; ?></span>
                    </span>
                </div>

            </div>
            <div class="info-text">
                <p><?php echo $mv['infocasy']; ?></p>
            </div>
        </div>

        <!-- =========== Video HOT =========== -->
        <div class="video-hot">
            <h2 class="title">VIDEO Ca Sỹ</h2>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->videos as $video){
                        $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$video['idmv']));
                        echo '<div class="album-item">
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
                            </div>';
                    }
                ?>
            </div>
        </div>

        <!-- =========== Album HOT =========== -->
        <div class="album-hot">
            <h2 class="title">ALBUM Ca Sỹ</h2>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->albums as $album){
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

        

        <div class="comments">
            <?php $url = URL::createLink('default', 'mv', 'mv', array('idmv'=>$mv['idmv'])); ?>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=1856760497949945&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-comments" data-href="<?php echo $url; ?>" data-numposts="5"></div>
        </div>

    </div>

    <!--======================= Content-right======================= -->
    <div class="content-right">
        <h2 class="title-section">Gợi ý</h2>
        <div class="list-goiy">
            <ul>
                <?php
                    foreach($suggests as $suggest){
                        $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$suggest['idmv']));
                        echo '<li>
                            <a href="'.$link.'">
                                <img src="public/images/mv/'.$suggest['hinhanh'].'" width="50" height="50" alt="">
                                <h3 class="tenbh-goiy">'.$suggest['tenbh'].'</h3>
                                <h4 class="tencasy-goiy">'.$suggest['tencasy'].'</h4>
                            </a>
                            <div class="tool-icon">
                                <div class="i25 download">
                                    <a href="'.PUBLIC_URL . 'mvs/' . $suggest['linkvideo'] .'" title="Download" download></a>
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