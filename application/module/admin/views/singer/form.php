<?php

    $form = array(
        'tencasy'           => '',
        'infocasy'          => '', 
    );

    $dataForm = (isset($this->arrParam['form'])) ? $this->arrParam['form'] : $form;

    $inputToken         = Helper::cmsInput('hidden', 'form[token]', 'token', time());

    $inputID	= '';
    $rowID		= '';

    if(isset($dataForm['idcasy'])){
        $inputID	        = '<input type="text" name="form[idcasy]" id="idbh" value="'.$dataForm['idcasy'].'" class="form-control" readonly>';
		$rowID		        = Helper::cmsFormRow('ID', $inputID);
    }
    //Input
    $inputTenCasy           = Helper::cmsInput('text', 'form[tencasy]', 'tencasy', null, 'form-control required');
    if(isset($dataForm['tencasy'])){
        $inputTenCasy       = Helper::cmsInput('text', 'form[tencasy]', 'tenbh', $dataForm['tencasy'], 'form-control required');
    }
    
    $inputHinhAnh           = Helper::cmsInput('file', 'form[hinhanh]', 'hinhanh', null, 'required');

    //CkEditor
    $txtInfo                = Helper::cmsEditor('form[infocasy]', 'infocasy', null);
    if(isset($dataForm['infocasy'])){
        $txtInfo            = Helper::cmsEditor('form[infocasy]', 'infocasy', $dataForm['infocasy']);
    }

    //Row
    $rowTenCasy             = Helper::cmsFormRow('Tên ca sỹ', $inputTenCasy, true);
    $rowHinhanh             = Helper::cmsFormRow('Hình ảnh', $inputHinhAnh, true);
    $rowInfo                = Helper::cmsFormRow('Info ca sỹ', $txtInfo, true);

    $this->errors = (isset($this->errors)) ? $this->errors : '';
?>

<div class="content">

    <div class="m-content">
        <?php include_once 'toolbar/toolbar.php'; ?>
        
        <div class="main">
        <?php echo $this->errors; ?>
        <form method="post" action="#" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <?php echo $rowID . $rowTenCasy . $rowHinhanh . $rowInfo; ?>
            <div class="button">
                <?php echo $inputToken; ?>
            </div>
        </form>
        </div>
    </div>

</div>


