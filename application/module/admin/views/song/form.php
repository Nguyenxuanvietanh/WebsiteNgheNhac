<?php

    $post = (isset($_POST['form'])) ? $_POST['form'] : '';
    $arrTheloai     = array(0 => 'Thể loại');
    $arrCasy        = array(0 => 'Tên ca sỹ');
    $arrNghesy      = array(0 => 'Tên tác giả');
    $arrAlbum       = array(0 => 'Tên Album');
    $arrQuocgia     = array(0 => 'Tên quốc gia');
    $arrChude       = array(0 => 'Tên chủ đề');

    $dataTheloai        = $this->theloai;
    $dataNghesy         = $this->nghesy;
    $dataCasy           = $this->casy;
    $dataAlbum          = $this->album;
    $dataQuocgia        = $this->quocgia;
    $dataChude          = $this->chude;

    foreach($dataTheloai as $theloai){
        $tentheloai = $theloai['tentheloai'];
        $idtheloai  = $theloai['idtheloai'];
        $arrTheloai[$idtheloai] = $tentheloai;
    }

    foreach($dataNghesy as $nghesy){
        $tennghesy = $nghesy['tennghesy'];
        $idnghesy  = $nghesy['idnghesy'];
        $arrNghesy[$idnghesy] = $tennghesy;
    }

    foreach($dataCasy as $casy){
        $tencasy = $casy['tencasy'];
        $idcasy  = $casy['idcasy'];
        $arrCasy[$idcasy] = $tencasy;
    }

    foreach($dataAlbum as $album){
        $tenalbum = $album['tenalbum'];
        $idalbum  = $album['idalbum'];
        $arrAlbum[$idalbum] = $tenalbum;
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
        'tenbh'         => '',
        'infobaihat'    => '', 
        'lyrics'        => '',
        'idnghesy'      => 0,
        'idcasy'        => 0,
        'idalbum'       => 0,
        'idquocgia'     => 0,
        'idtheloai'     => 0,
        'idchude'       => 0
    );

    $dataForm = (isset($this->arrParam['form'])) ? $this->arrParam['form'] : $form;

    $inputID	= '';
    $rowID		= '';
    $linkVideo  = '';
    if(isset($dataForm['idbaihat'])){
        $inputID	= '<input type="text" name="form[idbaihat]" id="idbh" value="'.$dataForm['idbaihat'].'" class="form-control" readonly>';
        $rowID		= Helper::cmsFormRow('ID', $inputID);
        
        $linkvd = URL::createLink('admin', 'mv', 'form', array('idbaihat'=>$dataForm['idbaihat']));
        $linkVideo = '<a href="'.$linkvd.'">Thêm Video</a>';
    }
    //Input
    $inputTenBH         = Helper::cmsInput('text', 'form[tenbh]', 'tenbh', null, 'form-control required');
    if(isset($dataForm['tenbh'])){
        $inputTenBH         = Helper::cmsInput('text', 'form[tenbh]', 'tenbh', $dataForm['tenbh'], 'form-control required');
    }
    
    $inputHinhAnh       = Helper::cmsInput('file', 'form[hinhanh]', 'hinhanh', null, 'required');
    $inputMP3           = Helper::cmsInput('file', 'form[mp3]', 'mp3', null, 'required');
    $inputNgayPH        = Helper::cmsInput('date', 'form[ngayphathanh]', 'ngayphathanh', null, 'ngay form-control required');  
    $inputHinhanhCT     = Helper::cmsInput('file', 'form[hinhanhct]', 'hinhanh', null, 'required');
    $inputToken         = Helper::cmsInput('hidden', 'form[token]', 'token', time());

    //Text-Area
    // $txtInfo            = Helper::cmsTextArea('form[infobaihat]', 'infobaihat', 4, 'form-control', $dataForm['info']);
    // $txtLyrics          = Helper::cmsTextArea('form[lyrics]', 'lyrics', 4, 'form-control', $dataForm['lyric']);

    //CkEditor
    $txtInfo            = Helper::cmsEditor('form[infobaihat]', 'infobaihat', null);
    if(isset($dataForm['infobaihat'])){
        $txtInfo            = Helper::cmsEditor('form[infobaihat]', 'infobaihat', $dataForm['infobaihat']);
    }
    $txtLyrics          = Helper::cmsEditor('form[lyrics]', 'lyrics', $dataForm['lyrics']);

    //Select Box
    $selectTacgia       = Helper::cmsSelectBox('form[idnghesy]', $arrNghesy, null);
    if(isset($dataForm['idnghesy'])){
        $selectTacgia       = Helper::cmsSelectBox('form[idnghesy]', $arrNghesy, $dataForm['idnghesy']);
    }

    $selectCasy         = Helper::cmsSelectBox('form[idcasy]', $arrCasy, null);
    if(isset($dataForm['idcasy'])){
        $selectCasy         = Helper::cmsSelectBox('form[idcasy]', $arrCasy, $dataForm['idcasy']);
    }
    
    $selectTheloai      = Helper::cmsSelectBox('form[idtheloai]', $arrTheloai, null);
    if(isset($dataForm['idtheloai'])){
        $selectTheloai      = Helper::cmsSelectBox('form[idtheloai]', $arrTheloai, $dataForm['idtheloai']);
    }
    $selectAlbum        = Helper::cmsSelectBox('form[idalbum]', $arrAlbum, $dataForm['idalbum']);
    $selectQuocgia      = Helper::cmsSelectBox('form[idquocgia]', $arrQuocgia, $dataForm['idquocgia']);
    $selectChude        = Helper::cmsSelectBox('form[idchude]', $arrChude, $dataForm['idchude']);
    

    
    //Checkbox
    //$cblTheLoai         = Helper::cmsCheckboxList('form[idtheloai]', $arrTheloai);
    //$cblDexuat          = Helper::cmsCheckboxList('form[dexuat]', array('true' => 'Tick'));
    $cbDexuat           = Helper::cmsCheckbox('form[dexuat]', array(1 => 'Tick'), true);

    //Row
    $rowTenBH           = Helper::cmsFormRow('Tên bài hát', $inputTenBH, true);
    $rowHinhanh         = Helper::cmsFormRow('Hình ảnh', $inputHinhAnh, true);
    $rowMP3             = Helper::cmsFormRow('MP3', $inputMP3, true);
    $rowHinhanhCT       = Helper::cmsFormRow('Hình ảnh CT', $inputHinhanhCT, true);
    $rowNgayPH          = Helper::cmsFormRow('Ngày phát hành', $inputNgayPH, true);
    $rowInfo            = Helper::cmsFormRow('Info bài hát', $txtInfo, true, 'info');
    $rowTacgia          = Helper::cmsFormRow('Tác giả', $selectTacgia, true);
    $rowCasy            = Helper::cmsFormRow('Ca sỹ', $selectCasy, true);
    $rowTheLoai         = Helper::cmsFormRow('Thể Loại', $selectTheloai, true);
    $rowDexuat          = Helper::cmsFormRow('Đề xuất', $cbDexuat, false);
    $rowAlbum           = Helper::cmsFormRow('Album', $selectAlbum, false);
    $rowQuocgia         = Helper::cmsFormRow('Quốc gia', $selectQuocgia, false);
    $rowChude           = Helper::cmsFormRow('Chủ đề', $selectChude, false);
    $rowLyrics          = Helper::cmsFormRow('Lyrics', $txtLyrics, false);

    $this->errors = (isset($this->errors)) ? $this->errors : '';
?>

<div class="content">

    <div class="m-content">
        <?php include_once 'toolbar/toolbar.php'; ?>
        
        <div class="main">
        <?php echo $this->errors; ?>
        <form method="post" action="#" name="adminForm" id="adminForm" enctype="multipart/form-data">
            <div class="form left">
                <?php echo $rowID . $rowTenBH . $rowHinhanh . $rowHinhanhCT . $rowMP3 . $rowNgayPH . $rowDexuat . $rowInfo; ?>
            </div>
            <div class="form right">
                <?php echo $rowTheLoai . $rowTacgia . $rowCasy . $rowAlbum . $rowQuocgia . $rowChude . $rowLyrics . $linkVideo; ?>
            </div>

            <div class="clr"></div>
            <div class="button">
                <?php echo $inputToken; ?>
            </div>
        </form>
        </div>
    </div>

</div>


