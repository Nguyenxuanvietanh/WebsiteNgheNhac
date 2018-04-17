<?php
?>
<div class="content">
    <div class="list-content">
        <h1 class="title-list">LIST CA SỸ <?php echo $this->nationName['tenquocgia']; ?></h1>
        <hr>
        <div class="row">
            <?php 
                foreach($this->listSinger as $singer){
                    $link = URL::createLink('default', 'singer', 'singer', array('idcasy'=>$singer['idcasy']));
                    echo '<div class="list-item">
                            <a href="'.$link.'" title="">
                                <img src="public/images/singers/'.$singer['hinhanh'].'" alt="">
                                <span class="icon-add"></span>
                            </a>
                            
                            <div class="des">
                                <h3 class="title-song">
                                    <a href="'.$link.'">'.$singer['tencasy'].'</a>
                                </h3>
                                <h4 class="singer-name">
                                    <a href="#">'.$singer['luotquantam'].' quan tâm</a>
                                </h4>
                            </div>
                        </div>';
                }
            ?>
        </div>

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
    
    
</div>