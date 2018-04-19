<?php
    $songData = $this->songData;
    $mp3 = 'public/mp3/'.$songData['mp3'];
    $url = URL::createLink('default', 'song', 'song', array('idbaihat'=>$this->arrParam['idbaihat']));
    $suggests   = $this->suggests;
    $linkSongCabinet = URL::createLink('default', 'song', 'songCabinet', array('idbaihat'=>$songData['idbaihat']));
?>
<div class="content">

    <div class="content-left">
        <div class="baihat">
            <div class="info-top-baihat">
                <span class="tenbaihat"><?php echo $songData['tenbh']; ?> - </span>
                <a class="casy-title" href="#"><?php echo $songData['tencasy']; ?></a>
                <div class="btn-like">
                    <?php
                        //$like = Helper::cmsLike($value['like'], URL::createLink('default', 'song', 'ajaxLike', array('id'=> $id,'status'=> $value['like'])), $id);
                    ?>
                    <a href="#" class="zlike" id="btnLike">
                        <span class="zicon" id="iconLike"></span>Thích
                    </a>
                    <span class="like-count">
                        <i></i>
                        <b></b>
                        <span class="fn-count"><?php echo $songData['luotthich']; ?></span>
                    </span>
                </div>
            </div>
            <div class="audio-player">
                <img src="public/images/songs/chitiet/<?php echo $songData['hinhanhct']; ?>" alt="">
                <div class="video-player" id="video-player">
                    <div>
                        <audio id="player">
                            <source src="public/mp3/<?php echo $songData['mp3']; ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    <div id="control">
                        <progress id="progress-bar" value="0" min="0" max="100"></progress>
                        <div class="left">
                            <div>
                                <span id="play-pause-btn" class="play"></span>
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
            <div class="info-song">
                <span>Sáng tác: </span>
                <h2>
                    <a href=""><?php echo $songData['tennghesy']; ?></a>
                </h2>
                <span>Album: </span>
                <h2>
                    <a href=""><?php echo $songData['tenalbum']; ?></a>
                </h2>
                <div class="clr"></div>
                <span>Thể loại: </span>
                <h2>
                    <a href=""><?php echo $songData['tentheloai']; ?></a>
                </h2>
            </div>

            <div class="button-group">
                <a href="<?php echo $linkSongCabinet; ?>" id="btnAdd">
                    <i class="z-icon zicon-add"></i>
                    <span>Thêm vào</span>
                </a>
                <a href="<?php echo PUBLIC_URL . 'mp3/' . $songData['mp3']; ?>" id="btnDownload" download>
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
                <span class="count-luotnghe"><?php echo number_format($songData['luotnghe']); ?></span>
            </div>
        </div>
        <div class="clr"></div>
        <!-- =========== Danh sách nhạc =========== -->
        <div class="lyric">
            <div class="lyric-title">
                <label>Lời bài hát: </label>
                <s class="song-title"><?php echo $songData['tenbh']; ?></s>
            </div>
            <p class="lyric-content" data-min="300px" data-max="auto">
                <textarea class="lyrics" disabled><?php echo $songData['lyrics']; ?></textarea> 
            </p>
        </div>

        <div class="box-casy">
            <a href="#" class="img-casy" >
                <img src="public/images/singers/<?php echo $songData['img-casy']; ?>" alt="" width="110" height="110">
            </a>
            <div class="info-casy">
                <h2>
                    <a href="#"><?php echo $songData['tencasy']; ?></a>
                </h2>
                <div class="subcribe">
                    <a href="#">
                        <span></span>
                        Quan tâm
                    </a>
                    <span class="like-count">
                        <i></i>
                        <b></b>
                        <span class="fn-count"><?php echo number_format($songData['luotquantam']); ?></span>
                    </span>
                </div>
                
            </div>
            <div class="info-text">
                <p><?php echo $songData['infocasy']; ?></p>
            </div>
        </div>
        <!-- =========== Album HOT =========== -->
        <div class="album-hot">
            <h2 class="title">ALBUM <?php echo $songData['tencasy']; ?></h2>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->albums as $album){
                        echo '<div class="album-item">
                            <div class="item-content">
                                <a href="#">
                                    <img src="public/images/albums/'.$album['hinhanh'].'" class="thumb" />
                                    <span class="icon-play"></span>
                                </a>
                                <div class="item-name">
                                    <a href="#">'.$album['tenalbum'].'</a>
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

        <!-- =========== Video HOT =========== -->
        <div class="video-hot">
            <h2 class="title">VIDEO <?php echo $songData['tencasy']; ?></h2>
            <p class="sub-title">Description</p>

            <div class="album">
                <?php
                    foreach($this->videos as $video){
                        echo '<div class="album-item">
                            <div class="item-content">
                                <a href="#">
                                    <img src="public/images/mv/'.$video['hinhanh'].'" class="thumb" />
                                    <span class="icon-play"></span>
                                </a>
                                <div class="item-name">
                                    <a href="#">'.$video['tenbh'].'</a>
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

        <div class="comments">
            <?php $url = URL::createLink('default', 'song', 'song', array('idbaihat'=>$songData['idbaihat'])); ?>
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
        <?php
            if(!empty($this->currentMV)){
                $currentMV = $this->currentMV;
                $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$currentMV['idmv']));
                echo '<h2 class="title-section">MV Bài Hát</h2>
                      <div class="current-mv">
                        <a href="'.$link.'">
                            <img src="public/images/mv/'.$currentMV['hinhanh'].'" width="50" height="50" alt="">
                        </a>
                        <a href="'.$link.'">
                            <h3 class="tenbh-goiy">'.$currentMV['tenbh'].'</h3>
                        </a>    
                        <a href="#">
                            <h4 class="tencasy-goiy">'.$currentMV['tencasy'].'</h4>
                        </a>
                      </div>
                      <hr>
                        ';
            }
        ?>
        <div class="clr"></div>
        <h2 class="title-section">Gợi ý</h2>
        <div class="list-goiy">
            <ul>
                <?php
                    foreach($suggests as $suggest){
                        echo '<li>
                            <a href="#">
                                <img src="public/images/singers/'.$suggest['hinhanh'].'" width="50" height="50" alt="">
                            </a>
                            <a href="#">
                                <h3 class="tenbh-goiy">'.$suggest['tenbh'].'</h3>
                            </a>    
                            <a href="#">
                                <h4 class="tencasy-goiy">'.$suggest['tencasy'].'</h4>
                            </a>
                            
                            <div class="tool-icon">
                                <div class="i25 download">
                                    <a href="'.PUBLIC_URL . 'mp3/' . $suggest['mp3'].'" title="Download" download></a>
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
<script type="text/javascript">
    $like = 0;
    $("a#btnLike").click(function(){
        $like++;
        if($like % 2 != 0){
            $("#iconLike").removeClass("zicon");
            $("#iconLike").addClass("liked");
        }else{
            $("#iconLike").removeClass("liked");
            $("#iconLike").addClass("zicon");
        }
    });
</script>
