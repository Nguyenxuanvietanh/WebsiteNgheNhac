<?php
    $linkAdd        = URL::createLink('admin', 'singer', 'form', '');
    $btnAdd         = Helper::cmsButton($linkAdd, 'icon-add');


    $linkDelete     = URL::createLink('admin', 'singer', 'delete', '');
    $btnDelete      = Helper::cmsButton($linkDelete, 'icon-delete', 'submit');

    $linkSave       = URL::createLink('admin', 'singer', 'form', array('type' => 'save'));
    $btnSave        = Helper::cmsButton($linkSave, 'icon-save', 'submit');

    $linkCancel     = URL::createLink('admin', 'singer', 'index', '');
    $btnCancel      = Helper::cmsButton($linkCancel, 'icon-cancel');

    



    switch($this->arrParams['action']){
        case 'index':
            $arrButton = $btnAdd . $btnDelete;
            break;
        
        case 'form':
            $arrButton = $btnSave . $btnCancel;
            break;
    }
?>
<div class="mn-bar">
    <div class="title">
        <div class="singer-icon">
        </div>
        <span style="font-size: 25px; font-weight: bold; line-height: 60px;">
            <?php echo $this->_title; ?>
        </span>
        
        <div class="controll">
        <?php echo $arrButton; ?>
        </div>
    </div>
</div>