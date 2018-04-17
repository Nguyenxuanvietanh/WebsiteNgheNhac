<?php
    $title = '';
    if(isset($this->arrParam['idtheloai'])){
        $title = $this->title['tentheloai'];
        $img_url = 'public/images/categories/';
    }
    if(isset($this->arrParam['idchude'])){
        $title = $this->title['tenchude'];
        $img_url = 'public/images/topics/';
    }

?>
<div class="banner">
    <?php echo '<img src="'.$img_url.$this->title['hinhanh'].'" alt="">'; ?>
</div>
<div class="content">
    
    <div class="clr"></div>
    <div class="content-left">
        <!-- =========== Danh sách nhạc =========== -->
        <div class="list-nhac">
            <h3 class="title">LIST <?php echo $title ?></h3>

            <div class="album">
                <?php
                    foreach($this->listSong as $song){
                        echo '<div class="album-item">
                                <div class="item-content">
                                    <a href="#">
                                        <img src="public/images/songs/'.$song['hinhanh'].'" class="thumb" />
                                        <span class="icon-play"></span>
                                    </a>
                                    <div class="item-name">
                                        <a href="#">'.$song['tenbh'].'</a>
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


    </div>

    <!--======================= Content-right======================= -->
    <div class="content-right">
        <div class="toppic-hot">
            <h3 class="title">Chủ đề khác
                <i class="icon-arrow"></i>
            </h3>
            <div class="chude">
                <ul>
                    <?php
                        foreach($this->suggestList as $suggest){
                            echo '<li>
                                    <a class="topic" href="#">
                                        <img src="'.$img_url.$suggest['hinhanh'].'" alt="">
                                    </a>
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