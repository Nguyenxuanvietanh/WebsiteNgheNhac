<?php
    $currentSong = $this->album[0];
    // echo '<pre>';
    // print_r($this->arrParam);
    // echo '</pre>';
?>
<div class="content">
    <div class="content-left">
        <div class="baihat">
            <div class="info-top-baihat">
                <span class="tenbaihat"><?php echo $currentSong['tenbh']; ?> - </span>
                <a class="casy-title" href="#"><?php echo $currentSong['tencasy']; ?></a>
                <div class="btn-like">
                    <a href="#" class="zlike">
                        <span class="zicon"></span>Thích
                    </a>
                    <span class="like-count">
                        <i></i>
                        <b></b>
                        <span class="fn-count"><?php echo $currentSong['luotthich']; ?></span>
                    </span>
                </div>
            </div>
            <div class="audio-player">
                <img src="public/images/songs/chitiet/<?php echo $currentSong['hinhanhct']; ?>" alt="">
                <div class="video-player" id="video-player">
                    <div>
                        <audio id="player">
                            <source src="public/mp3/<?php echo $currentSong['mp3']; ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    <div id="control">
                        <progress id="progress-bar" value="0" min="0" max="100"></progress>
                        <div class="left">
                            <div class="pre">
                                <img id="btn-prev" src="public/images/interface/prev.png" alt="">
                            </div>
                            <div style="float:left;">
                                <span id="play-pause-btn" class="play"></span>
                            </div>
                            <div class="next">
                                <img id="btn-next" src="public/images/interface/next.png" alt="">
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
                            <span id="replay" class="unreplay">
                                <img id="btn-replay" src="public/images/interface/replay-icon.png" alt="">
                            </span>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="clr"></div>
            <ul class="list-song">
                <?php
                    $i = 1;
                    foreach($this->album as $songItem){
                        echo '<li class="item-song row">
                            <div class="col-1">
                                <span>0'.$i.'</span>
                            </div>
                            <div class="col-5">
                                <a id="tenbh" href="#">'.$songItem['tenbh'].'</a>
                            </div>
                            <div class="col-3">
                                <a href="#">'.$songItem['tencasy'].'</a>
                            </div>
                            <div class="tool-icon">
                                <div class="i25 download">
                                    <a href="'.PUBLIC_URL . 'mp3/' . $songItem['mp3'].'" title="Download"></a>
                                </div>
                                <div class="i25 addlist">
                                    <a href="#" title="Addlist"></a>
                                </div>
                                <div class="i25 share">
                                    <a href="#" title="Share"></a>
                                </div>
                            </div>
                        </li>';
                        $i++;
                    }
                ?>
            </ul>

            <div class="button-group">
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
                <span class="count-luotnghe"><?php echo $currentSong['luotnghe']; ?></span>
            </div>
        </div>
        <div class="clr"></div>
        <!-- =========== Danh sách nhạc =========== -->
        <div class="lyric">
            <div class="lyric-title">
                <label>Lời bài hát: </label>
                <s class="song-title"><?php echo $currentSong['tenbh']; ?></s>
            </div>
            <p class="lyric-content" data-min="300px" data-max="auto">
                <textarea class="lyrics" disabled><?php echo $currentSong['lyrics']; ?></textarea> 
            </p>
        </div>

        <div class="box-casy">
            <a href="#" class="img-casy" >
                <img src="public/images/singers/<?php echo $currentSong['img-casy']; ?>" alt="" width="110" height="110">
            </a>
            <div class="info-casy">
                <h2>
                    <a href="#"><?php echo $currentSong['tencasy']; ?></a>
                </h2>
                <div class="subcribe">
                    <a href="#">
                        <span></span>
                        Quan tâm
                    </a>
                    <span class="like-count">
                        <i></i>
                        <b></b>
                        <span class="fn-count"><?php echo $currentSong['luotquantam']; ?></span>
                    </span>
                </div>
                
            </div>
            <div class="info-text">
                <p>info</p>
            </div>
        </div>

        <!-- =========== Album HOT =========== -->
        <div class="album-hot">
            <h2 class="title">ALBUM <?php echo $currentSong['tencasy']; ?></h2>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->singerAlbum as $album){
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
            <h2 class="title">VIDEO <?php echo $currentSong['tencasy']; ?></h2>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->singerMV as $mv){
                        $linkmv = URL::createLink('default', 'mv', 'mv', array('idalbum'=>$mv['idmv']));
                        echo '
                        <div class="album-item">
                            <div class="item-content">
                                <a href="'.$linkmv.'">
                                    <img src="public/images/mv/'.$mv['hinhanh'].'" class="thumb" />
                                    <span class="icon-play"></span>
                                </a>
                                <div class="item-name">
                                    <a href="'.$linkmv.'">'.$mv['tenbh'].'</a>
                                </div>
                                <div class="item-singer">
                                    <a href="#">'.$mv['tencasy'].'</a>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>
            </div>
        </div>

        <div class="comments">
            <?php $url = URL::createLink('default', 'album', 'album', array('idalbum'=>$this->arrParam['idalbum'])); ?>
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
                    foreach($this->suggests as $suggest){
                        $link = URL::createLink('default', 'album', 'album', array('idalbum'=>$suggest['idalbum']));
                        echo '<li>
                                <a href="'.$link.'">
                                    <img src="public/images/albums/'.$suggest['hinhanh'].'" width="50" height="50" alt="">
                                    <h3 class="tenbh-goiy">'.$suggest['tenalbum'].'</h3>
                                    <h4 class="tencasy-goiy">'.$suggest['tencasy'].'</h4>
                                </a>
                            </li>';
                    }
                ?>
            </ul>
        </div>
    </div>

    <div class="clr"></div>
</div>