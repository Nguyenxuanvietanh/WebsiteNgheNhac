<?php

    $form = array(
        'tennghesy'           => '',
        'infonghesy'          => '', 
    );

    $dataQuocgia = $this->quocgia;
    foreach($dataQuocgia as $quocgia){
        $tenquocgia = $quocgia['tenquocgia'];
        $idquocgia  = $quocgia['idquocgia'];
        $arrQuocgia[$idquocgia] = $tenquocgia;
    }

    $dataForm = (isset($this->arrParam['form'])) ? $this->arrParam['form'] : $form;

    $inputToken         = Helper::cmsInput('hidden', 'form[token]', 'token', time());

    $inputID	= '';
    $rowID		= '';

    if(isset($dataForm['idnghesy'])){
        $inputID	        = '<input type="text" name="form[idnghesy]" id="idbh" value="'.$dataForm['idnghesy'].'" class="form-control" readonly>';
		$rowID		        = Helper::cmsFormRow('ID', $inputID);
    }
    //Input
    $inputTennghesy           = Helper::cmsInput('text', 'form[tennghesy]', 'tennghesy', null, 'form-control required');
    if(isset($dataForm['tennghesy'])){
        $inputTennghesy       = Helper::cmsInput('text', 'form[tennghesy]', 'tenbh', $dataForm['tennghesy'], 'form-control required');
    }
    
    $inputHinhAnh           = Helper::cmsInput('file', 'form[hinhanh]', 'hinhanh', null, 'required');

    //CkEditor
    $txtInfo                = Helper::cmsEditor('form[infonghesy]', 'infonghesy', null);
    if(isset($dataForm['infonghesy'])){
        $txtInfo            = Helper::cmsEditor('form[infonghesy]', 'infonghesy', $dataForm['infonghesy']);
    }

    //SELECT BOX
    $selectQuocgia      = Helper::cmsSelectBox('form[idquocgia]', $arrQuocgia, null);
    if(isset($dataForm['idquocgia'])){
        $selectQuocgia      = Helper::cmsSelectBox('form[idquocgia]', $arrQuocgia, $dataForm['idquocgia']);
    }

    //Row
    $rowTennghesy           = Helper::cmsFormRow('Tên nhạc sỹ', $inputTennghesy, true);
    $rowHinhanh             = Helper::cmsFormRow('Hình ảnh', $inputHinhAnh, true);
    $rowInfo                = Helper::cmsFormRow('Info nhạc sỹ', $txtInfo, true);
    $rowQuocgia             = Helper::cmsFormRow('Quốc gia', $selectQuocgia, false);

    $this->errors = (isset($this->errors)) ? $this->errors : '';
?>

<div class="content">

    <div class="m-content">
        <?php include_once 'toolbar/toolbar.php'; ?>
        
        <div class="main">
        <?php echo $this->errors; ?>
        <form method="post" action="#" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <?php echo $rowID . $rowTennghesy . $rowHinhanh . $rowQuocgia . $rowInfo; ?>
            <div class="button">
                <?php echo $inputToken; ?>
            </div>
        </form>
        </div>
    </div>

</div>


