<?php
    // echo '<pre>';
    // print_r($this->listAlbum);
    // echo '</pre>';
?>

<div class="content">
    <div class="menu-left">
        <div class="data-list-title">
            <h1>
                <?php
                    $link = URL::createLink('default', 'mv', 'index');
                    echo '<a href="'.$link.'">MV HOT</a>';
                ?>
            </h1>
        </div>
        <div class="data-list">
            <div class="item-data-list">
                <div class="data-list-title">
                    <a href="#">Thể Loại</a>
                </div>
                <div class="item-mnleft">
                    <?php
                        foreach($this->listTheloai as $theloai){
                            $link = URL::createLink('default', 'mv', 'index', array('idtheloai'=>$theloai['idtheloai']));
                            echo '<a href="'.$link.'">'.$theloai['tentheloai'].'</a>';
                        }
                    ?>
                </div>

                <div class="data-list-title">
                    <a href="#">Chủ Đề</a>
                </div>
                <div class="item-mnleft">
                    <?php
                        foreach($this->listChude as $chude){
                            $link = URL::createLink('default', 'mv', 'index', array('idchude'=>$chude['idchude']));
                            echo '<a href="'.$link.'">'.$chude['tenchude'].'</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="list-content">
        
        <?php
            if(isset($this->arrParam['idtheloai'])){
                echo '<h1 class="title-list">'.$this->title['tentheloai'].'</h1><hr>';
                foreach($this->listMV as $mv){
                    $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$mv['idmv']));
                    echo '<div class="list-item col-3">
                                <a href="'.$link.'" title="">
                                    <img src="public/images/mv/'.$mv['hinhanh'].'" alt="">
                                    <span class="icon-play"></span>
                                </a>
                                
                                <div class="des">
                                    <h3 class="title-song">
                                        <a href="'.$link.'">'.$mv['tenbh'].'</a>
                                    </h3>
                                    <h4 class="singer-name">
                                        <a href="#">'.$mv['tencasy'].'</a>
                                    </h4>
                                </div>
                            </div>';
                }
            }else if(isset($this->arrParam['idchude'])){
                echo '<h1 class="title-list">'.$this->title['tenchude'].'</h1><hr>';
                foreach($this->listMV as $mv){
                    $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$mv['idmv']));
                    echo '<div class="list-item col-3">
                                <a href="'.$link.'" title="">
                                    <img src="public/images/mv/'.$mv['hinhanh'].'" alt="">
                                    <span class="icon-play"></span>
                                </a>
                                
                                <div class="des">
                                    <h3 class="title-song">
                                        <a href="'.$link.'">'.$mv['tenbh'].'</a>
                                    </h3>
                                    <h4 class="singer-name">
                                        <a href="#">'.$mv['tencasy'].'</a>
                                    </h4>
                                </div>
                            </div>';
                }
            }
            else{
                for($i = 0; $i < count($this->listMV); $i++){
                    echo '<h1 class="title-list">'.$this->quocgias[$i]['tenquocgia'].'</h1><hr>';
                    echo '<div  class= "row">';
                    
                    foreach($this->listMV[$i] as $mv){
                        $link = URL::createLink('default', 'mv', 'mv', array('idmv'=>$mv['idmv']));
                        echo '<div class="list-item col-3">
                                <a href="'.$link.'" title="">
                                    <img src="public/images/mv/'.$mv['hinhanh'].'" alt="">
                                    <span class="icon-play"></span>
                                </a>
                                
                                <div class="des">
                                    <h3 class="title-song">
                                        <a href="'.$link.'">'.$mv['tenbh'].'</a>
                                    </h3>
                                    <h4 class="singer-name">
                                        <a href="#">'.$mv['tencasy'].'</a>
                                    </h4>
                                </div>
                            </div>';
                    }
                    echo '</div>';
                } 
            }
        ?>
            

        <div class="clr"></div>
        <div class="pagination">
            <ul>
                <li>
                    <a href="#" class="active">1</a>
                </li>
                <li>
                    <a href="#">2</a>
                </li>
                <li>
                    <a href="#">3</a>
                </li>
            </ul>
        </div>
        
    </div>
    
    <div class="clr"></div>
</div>