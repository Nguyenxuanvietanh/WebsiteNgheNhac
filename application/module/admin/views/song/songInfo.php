<?php
    //MESSAGE
    $message = Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);
    // $info = array(
    //     'hinhanh'=>'',
    //     'mp3'=>'',
    //     'tencasy'=>'',
    //     'tennghesy'=>'',
    //     'tentheloai'=>'',
    //     'ngayphathanh'=>'',
    //     'tenalbum'=>'',
    //     'tenquocgia'=>'',
    //     'infobaihat'=>'',
    //     'luotnghe'=>'',
    //     'luotthich'=>'',
    //     'luottai'=>'',
    //     'lyrics'=>''
    // );
    // $this->info = (empty($this->info)) ? $this->info : $info;
?>

<div class="content">

    <div class="m-content">
        <?php include_once 'toolbar/toolbar.php'; ?>
        <?php echo $strMessage; ?>
        <div class="main">
            <div class="song-content">
                <h3><?php echo $this->info['tenbh'] ?></h3>
                <div class="audio col-3">
                    <?php 
                        echo '<img src="public/images/songs/'.$this->info['hinhanh'].'" alt="" width="100%" height="254">
                            <audio controls>
                                <source src="public/mp3/'.$this->info['mp3'].'" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            ';
                    ?>
                    
                </div>
                <div class="col-1"></div>
                <div class="info col-8">
                    <div class="left col-6">
                        <?php 
                            echo '
                                <p>Thể hiện: <span>'.$this->info['tencasy'].'</span> </p>
                                <p>Sáng tác: <span>'.$this->info['tennghesy'].'</span></p>
                                <p>Thể loại: <span>'.$this->info['tentheloai'].'</span></p>
                                <p>Ngày phát hành: <span>'.date("d-m-Y", strtotime($this->info['ngayphathanh'])).'</span></p>
                                <p>Album: <span>'.$this->info['tenalbum'].'</span></p>
                                <p>Quốc gia: <span>'.$this->info['tenquocgia'].'</span></p>
                                <p>Chủ đề: <span>'.$this->info['tenchude'].'</span></p>
                                <p>Info: <span>'.$this->info['infobaihat'].'</span></p>
                                <p>Lượt nghe: <span>'.$this->info['luotnghe'].'</span></p>
                                <p>Lượt thích: <span>'.$this->info['luotthich'].'</span></p>
                                <p>Lượt tải: <span>'.$this->info['luottai'].'</span></p> 
                                
                                ';
                        ?>
                        
                    </div>
                    <div style="float: right; width: 50%">
                        <?php echo '<p>Lyrics: </p><textarea class="lyrics" disabled>'.$this->info['lyrics'].'</textarea> '; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>