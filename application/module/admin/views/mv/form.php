<?php

    $form = array(
        'tenbaihat'           => '',
        'infomv'          => '', 
    );

    $dataForm = (isset($this->arrParam['form'])) ? $this->arrParam['form'] : $form;

    $inputToken             = Helper::cmsInput('hidden', 'form[token]', 'token', time());

    $inputID	= '';
    $rowID		= '';

    if(isset($dataForm['idmv'])){
        $inputID	        = '<input type="text" name="form[idmv]" id="idmv" value="'.$dataForm['idmv'].'" class="form-control" readonly>';
		$rowID		        = Helper::cmsFormRow('ID', $inputID);
    }

    $inputTenBH             = Helper::cmsInput('text', 'form[tenbh]', 'tenbh', $dataForm['tenbh'], 'form-control required ');
    // if(isset($dataForm['tenbh'])){
    //     $inputTenBH         = '<input type="text" name="form[tenbh]" id="tenbh" value="'.$dataForm['tenbh'].'" class="form-control" readonly>';
    // }

    $inputIDBH             = Helper::cmsInput('hidden', 'form[idbaihat]', 'idbaihat', null, 'form-control required ');
    if(isset($dataForm['idbaihat'])){
        $inputIDBH         = '<input type="hidden" name="form[idbaihat]" id="idbaihat" value="'.$dataForm['idbaihat'].'" class="form-control" readonly>';
    }

    $inputVideo             = Helper::cmsInput('file', 'form[video]', 'video', null, 'required');
    $inputHinhAnh           = Helper::cmsInput('file', 'form[hinhanh]', 'hinhanh', null, 'required');

    //CkEditor
    $txtInfo                = Helper::cmsEditor('form[infomv]', 'infomv', null);
    if(isset($dataForm['infomv'])){
        $txtInfo            = Helper::cmsEditor('form[infomv]', 'infomv', $dataForm['infomv']);
    }

    $cbDexuat           = Helper::cmsCheckbox('form[dexuat]', array(1 => 'Tick'), true);

    //Row
    $rowTenBH               = Helper::cmsFormRow('Tên bài hát', $inputTenBH, true);
    $rowHinhanh             = Helper::cmsFormRow('Hình ảnh', $inputHinhAnh, true);
    $rowVideo               = Helper::cmsFormRow('Video', $inputVideo, true);
    $rowDexuat              = Helper::cmsFormRow('Đề xuất', $cbDexuat, false);
    $rowInfo                = Helper::cmsFormRow('Info mv', $txtInfo, true);

    $this->errors = (isset($this->errors)) ? $this->errors : '';
?>

<div class="content">

    <div class="m-content">
        <?php include_once 'toolbar/toolbar.php'; ?>
        
        <div class="main">
        <?php echo $this->errors; ?>
        <form method="post" action="#" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <?php echo $rowID . $rowTenBH . $rowHinhanh . $rowVideo . $rowDexuat . $rowInfo; ?>
            <div class="button">
                <?php echo $inputToken . $inputIDBH; ?>
            </div>
        </form>
        </div>
    </div>

</div>


