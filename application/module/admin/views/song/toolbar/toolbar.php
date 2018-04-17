<?php
    $linkAdd        = URL::createLink('admin', 'song', 'form', '');
    $btnAdd         = Helper::cmsButton($linkAdd, 'icon-add');

    $linkCheck      = URL::createLink('admin', 'song', 'status', array('type' => 1));
    $btnCheck       = Helper::cmsButton($linkCheck, 'icon-check', 'submit');

    $linkUnCheck    = URL::createLink('admin', 'song', 'status', array('type' => 0));
    $btnUnCheck     = Helper::cmsButton($linkUnCheck, 'icon-uncheck', 'submit');

    $linkDelete     = URL::createLink('admin', 'song', 'delete', '');
    $btnDelete      = Helper::cmsButton($linkDelete, 'icon-delete', 'submit');

    $linkSave       = URL::createLink('admin', 'song', 'form', array('type' => 'save'));
    $btnSave        = Helper::cmsButton($linkSave, 'icon-save', 'submit');

    // $linkSaveClose  = URL::createLink('admin', 'song', 'form', array('type' => 'save-close'));
    // $btnSaveClose   = Helper::cmsButton($linkSaveClose, 'icon-save-close', 'submit');

    $linkSaveNew    = URL::createLink('admin', 'mv', 'form', array('type' => 'save-new'));
    $btnSaveNew     = Helper::cmsButton($linkSaveNew, 'icon-save-new');

    $linkCancel     = URL::createLink('admin', 'song', 'index', '');
    $btnCancel      = Helper::cmsButton($linkCancel, 'icon-cancel');

    



    switch($this->arrParams['action']){
        case 'index':
            $arrButton = $btnAdd . $btnCheck . $btnUnCheck . $btnDelete;
            break;
        
        case 'form':
            $arrButton = $btnSave . $btnSaveNew . $btnCancel;
            break;
        case 'showInfo':
            $btnEdit        = Helper::cmsButton($this->linkEdit, 'icon-edit');
            $arrButton = $btnEdit . $btnCancel ;
            break;
    }
?>
<div class="mn-bar">
    <div class="title">
        <div class="music-icon">
        </div>
        <span style="font-size: 25px; font-weight: bold; line-height: 60px;">
            <?php echo $this->_title; ?>
        </span>
        
        <div class="controll">
        <?php echo $arrButton; ?>
        </div>
    </div>
</div>