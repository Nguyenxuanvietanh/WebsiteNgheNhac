<?php

    $linkDelete     = URL::createLink('admin', 'category', 'delete', '');
    $btnDelete      = Helper::cmsButton($linkDelete, 'icon-delete', 'submit');

    $linkSave       = URL::createLink('admin', 'category', 'index', array('type' => 'save'));
    $btnSave        = Helper::cmsButton($linkSave, 'icon-save', 'submit');

    $linkCancel     = URL::createLink('admin', 'category', 'index', '');
    $btnCancel      = Helper::cmsButton($linkCancel, 'icon-cancel');

    



    switch($this->arrParams['action']){
        case 'index':
            $arrButton = $btnSave . $btnDelete;
            break;
        case 'form':
            $arrButton = $btnSave . $btnCancel;
            break;
    }
?>
<div class="mn-bar">
    <div class="title">
        <div class="category-icon">
        </div>
        <span style="font-size: 25px; font-weight: bold; line-height: 60px;">
            <?php echo $this->_title; ?>
        </span>
        
        <div class="controll">
        <?php echo $arrButton; ?>
        </div>
    </div>
</div>