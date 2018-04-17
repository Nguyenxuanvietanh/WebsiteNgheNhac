<?php

    $post = (isset($_POST['form'])) ? $_POST['form'] : '';
    $arrTheloai     = array(0 => 'Thể loại');
    $arrCasy        = array(0 => 'Tên ca sỹ');
    $arrQuocgia     = array(0 => 'Tên quốc gia');
    $arrChude       = array(0 => 'Tên chủ đề');

    $dataTheloai        = $this->theloai;
    $dataCasy           = $this->casy;
    $dataQuocgia        = $this->quocgia;
    $dataChude          = $this->chude;

    foreach($dataTheloai as $theloai){
        $tentheloai = $theloai['tentheloai'];
        $idtheloai  = $theloai['idtheloai'];
        $arrTheloai[$idtheloai] = $tentheloai;
    }

    foreach($dataCasy as $casy){
        $tencasy = $casy['tencasy'];
        $idcasy  = $casy['idcasy'];
        $arrCasy[$idcasy] = $tencasy;
    }

    foreach($dataQuocgia as $quocgia){
        $tenquocgia = $quocgia['tenquocgia'];
        $idquocgia  = $quocgia['idquocgia'];
        $arrQuocgia[$idquocgia] = $tenquocgia;
    }

    foreach($dataChude as $chude){
        $tenchude = $chude['tenchude'];
        $idchude  = $chude['idchude'];
        $arrChude[$idchude] = $tenchude;
    }
    $form = array(
        'tenalbum'      => '',
        'infoalbum'     => '', 
        'idcasy'        => 0,
        'idquocgia'     => 0,
        'idtheloai'     => 0,
        'idchude'       => 0
    );

    $dataForm = (isset($this->arrParam['form'])) ? $this->arrParam['form'] : $form;

    $inputID	= '';
    $rowID		= '';
    $linkVideo  = '';
    if(isset($dataForm['idalbum'])){
        $inputID	= '<input type="text" name="form[idalbum]" id="idalbum" value="'.$dataForm['idalbum'].'" class="form-control" readonly>';
        $rowID		= Helper::cmsFormRow('ID', $inputID);
    }
    //Input
    $inputTenAlbum         = Helper::cmsInput('text', 'form[tenalbum]', 'tenalbum', null, 'form-control required');
    if(isset($dataForm['tenalbum'])){
        $inputTenAlbum         = Helper::cmsInput('text', 'form[tenalbum]', 'tenalbum', $dataForm['tenalbum'], 'form-control required');
    }
    
    $inputHinhAnh       = Helper::cmsInput('file', 'form[hinhanh]', 'hinhanh', null, 'required');
    $inputToken         = Helper::cmsInput('hidden', 'form[token]', 'token', time());

    //CkEditor
    $txtInfo            = Helper::cmsEditor('form[infoalbum]', 'infoalbum', null);
    if(isset($dataForm['infoalbum'])){
        $txtInfo            = Helper::cmsEditor('form[infoalbum]', 'infoalbum', $dataForm['infoalbum']);
    }

    //Select Box

    $selectCasy         = Helper::cmsSelectBox('form[idcasy]', $arrCasy, null);
    if(isset($dataForm['idcasy'])){
        $selectCasy         = Helper::cmsSelectBox('form[idcasy]', $arrCasy, $dataForm['idcasy']);
    }
    
    $selectTheloai      = Helper::cmsSelectBox('form[idtheloai]', $arrTheloai, null);
    if(isset($dataForm['idtheloai'])){
        $selectTheloai      = Helper::cmsSelectBox('form[idtheloai]', $arrTheloai, $dataForm['idtheloai']);
    }

    $selectQuocgia      = Helper::cmsSelectBox('form[idquocgia]', $arrQuocgia, $dataForm['idquocgia']);
    $selectChude        = Helper::cmsSelectBox('form[idchude]', $arrChude, $dataForm['idchude']);
    

    
    //Checkbox
    $cbDexuat           = Helper::cmsCheckbox('form[dexuat]', array(1 => 'Tick'), true);

    //Row
    $rowTenAlbum        = Helper::cmsFormRow('Tên Album', $inputTenAlbum, true);
    $rowHinhanh         = Helper::cmsFormRow('Hình ảnh', $inputHinhAnh, true);
    $rowInfo            = Helper::cmsFormRow('Info Album', $txtInfo, true, 'info');
    $rowCasy            = Helper::cmsFormRow('Ca sỹ', $selectCasy, true);
    $rowTheLoai         = Helper::cmsFormRow('Thể Loại', $selectTheloai, true);
    $rowDexuat          = Helper::cmsFormRow('Đề xuất', $cbDexuat, false);
    $rowQuocgia         = Helper::cmsFormRow('Quốc gia', $selectQuocgia, false);
    $rowChude           = Helper::cmsFormRow('Chủ đề', $selectChude, false);


    $this->errors = (isset($this->errors)) ? $this->errors : '';
?>

<div class="content">

    <div class="m-content">
        <?php include_once 'toolbar/toolbar.php'; ?>
        
        <div class="main">
        <?php echo $this->errors; ?>
        <form method="post" action="#" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <?php 
                echo $rowID . $rowTenAlbum . $rowHinhanh . $rowDexuat;
            ?>
            <div class="row">
                <div class="col-3">
                    <?php echo $rowCasy; ?>
                </div>
                <div class="col-3">
                    <?php echo $rowTheLoai; ?>
                </div>
                <div class="col-3">
                    <?php echo $rowQuocgia; ?>
                </div>
                <div class="col-3">
                    <?php echo $rowChude; ?>
                </div>
            </div>
            <?php
                echo $rowInfo;
            ?>
            <div class="clr"></div>
            <div class="button">
                <?php echo $inputToken; ?>
            </div>
        </form>
        </div>
    </div>

</div>


