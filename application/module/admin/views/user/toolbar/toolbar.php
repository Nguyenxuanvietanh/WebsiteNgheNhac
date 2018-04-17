<?php
    $linkUp        = URL::createLink('admin', 'user', 'upgrade', '');
    $btnUp        = Helper::cmsButton($linkUp, 'icon-up', 'submit');

    $linkDown        = URL::createLink('admin', 'user', 'downgrade', '');
    $btnDown        = Helper::cmsButton($linkDown, 'icon-down', 'submit');

    $linkDelete     = URL::createLink('admin', 'user', 'delete', '');
    $btnDelete      = Helper::cmsButton($linkDelete, 'icon-delete', 'submit');

    $arrButton = '';
    
    if($_SESSION['user']['idloaiuser'] == 1){
        $arrButton = $btnUp . $btnDown . $btnDelete;
    }
?>
<div class="mn-bar">
    <div class="title">
        <div class="user-icon">
        </div>
        <span style="font-size: 25px; font-weight: bold; line-height: 60px;">
            <?php echo $this->_title; ?>
        </span>

        <div class="controll">
            <?php echo $arrButton; ?>
        </div>
        
    </div>
</div>