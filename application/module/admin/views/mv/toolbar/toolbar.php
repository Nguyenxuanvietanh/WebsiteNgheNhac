<?php
    $linkCheck      = URL::createLink('admin', 'mv', 'status', array('type' => 1));
    $btnCheck       = Helper::cmsButton($linkCheck, 'icon-check', 'submit');

    $linkUnCheck    = URL::createLink('admin', 'mv', 'status', array('type' => 0));
    $btnUnCheck     = Helper::cmsButton($linkUnCheck, 'icon-uncheck', 'submit');

    $linkDelete     = URL::createLink('admin', 'mv', 'delete', '');
    $btnDelete      = Helper::cmsButton($linkDelete, 'icon-delete', 'submit');

    $linkSave       = URL::createLink('admin', 'mv', 'form', array('type' => 'save'));
    $btnSave        = Helper::cmsButton($linkSave, 'icon-save', 'submit');

    $linkCancel     = URL::createLink('admin', 'mv', 'index', '');
    $btnCancel      = Helper::cmsButton($linkCancel, 'icon-cancel');


    switch($this->arrParams['action']){
        case 'index':
            $arrButton = $btnCheck . $btnUnCheck . $btnDelete;
            break;
        case 'form':
            $arrButton = $btnSave . $btnCancel;
            break;
    }

?>
<div class="mn-bar">
    <div class="title">
        <div class="video-icon">
        </div>
        <span style="font-size: 25px; font-weight: bold; line-height: 60px;">
            <?php echo $this->_title; ?>
        </span>
        
        <div class="controll">
        <?php echo $arrButton; ?>
        </div>
    </div>
</div>