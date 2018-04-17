<?php
class SongController extends Controller{
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){		
		$this->_view->_title = 'Quản lý bài hát';
		$totalItems = $this->_model->countSong($this->_arrParam);
		$configPagination = array('totalItemsPerPage' => 5, 'pageRange' => 5);
		$this->setPagination($configPagination);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);
		$this->_view->songItems = $this->_model->listSong($this->_arrParam);
		$this->_view->appendCSS(array('song/css/checkbox-label.css','song/css/style.css'));
	    $this->_view->appendJS(array('song/js/jquery.min.js','song/js/bootstrap.min.js'));
		$this->_view->render('song/index');
	}

	//FORM ACTION
	public function formAction(){
		$this->_view->_title = 'Thêm bài hát';
		$albumCondition = '';
		if(isset($this->_arrParam['idbh'])){
			$this->_view->_title = 'Sửa thông tin bài hát';
			$this->_view->arrParam['form'] = $this->_model->showInfoItems($this->_arrParam['idbh']);
			if(empty($this->_view->arrParam['form'])) URL::redirect(URL::createLink('admin', 'song', 'index'));
		}
		
		$this->_view->nghesy 	= $this->_model->dataRow('nghesy', 'tennghesy', 'idnghesy');
		$this->_view->casy 	 	= $this->_model->dataRow('casy', 'tencasy', 'idcasy');
		$this->_view->album  	= $this->_model->dataRow('album', 'tenalbum', 'idalbum', $albumCondition);
		$this->_view->quocgia	= $this->_model->dataRow('quocgia', 'tenquocgia', 'idquocgia');
		$this->_view->theloai	= $this->_model->dataRow('theloai', 'tentheloai', 'idtheloai');
		$this->_view->chude		= $this->_model->dataRow('chude', 'tenchude', 'idchude');

		if(!isset($this->_arrParam['form'])){
			$this->_arrParam['form']['token'] = '';
		}

		
		if($this->_arrParam['form']['token'] > 0){
			$this->_arrParam['form']['hinhanh'] = $_FILES['form']['name']['hinhanh'];
			$this->_arrParam['form']['hinhanhct'] = $_FILES['form']['name']['hinhanhct'];
			$this->_arrParam['form']['mp3']	 	= $_FILES['form']['name']['mp3'];

			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('tenbh', 'string', array('min' => 1, 'max' => 255))
					 ->addRule('hinhanh', 'file', array('extension' => array('png','gif','jpg','jpeg')))
					 ->addRule('mp3', 'file', array('extension' => array('mp3')))
					 ->addRule('hinhanhct', 'file', array('extension' => array('png','gif','jpg','jpeg')))
					 ->addRule('infobaihat', 'string', array('min' => 1, 'max' => 1000))
					 ->addRule('ngayphathanh', 'string', array('min' => 10, 'max' => 10))
					 ->addRule('idtheloai', 'status', array('deny' => array('0')))
					 ->addRule('idnghesy', 'status', array('deny' => array('0')))
					 ->addRule('idcasy', 'status', array('deny' => array('0')));
			$validate->run();

			$this->_arrParam['form'] = $validate->getResult();
			
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}
			else{

				$task	= (isset($this->_arrParam['form']['idbaihat'])) ? 'edit' : 'add';

				$ten_bh = strtolower(Helper::convert_vi_to_en($this->_arrParam['form']['tenbh'])) . time();
				
				$target_dir = PUBLIC_PATH ."images/songs/";
				$target_file = $target_dir . basename($_FILES["form"]["name"]["hinhanh"]);
   				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$name = $ten_bh . '.' . $imageFileType;
				$image_base64 = base64_encode(file_get_contents($_FILES['form']['tmp_name']['hinhanh']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				move_uploaded_file($_FILES['form']['tmp_name']['hinhanh'],$target_dir.$name);

				$target_dir_ct = PUBLIC_PATH ."images/songs/chitiet/";
				$target_file = $target_dir_ct . basename($_FILES["form"]["name"]["hinhanhct"]);
   				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$namect = $ten_bh . '.' . $imageFileType;
				$image_base64 = base64_encode(file_get_contents($_FILES['form']['tmp_name']['hinhanhct']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				move_uploaded_file($_FILES['form']['tmp_name']['hinhanhct'],$target_dir_ct.$namect);

				$target_dirmp3 = PUBLIC_PATH ."mp3/";
				$mp3_name = $ten_bh . '.mp3';
				move_uploaded_file($_FILES['form']['tmp_name']['mp3'],$target_dirmp3.$mp3_name);

				$this->_arrParam['form']['hinhanh'] = $ten_bh .'.'. $imageFileType;
				$this->_arrParam['form']['hinhanhct'] = $ten_bh .'.'. $imageFileType;
				$this->_arrParam['form']['mp3']		= $ten_bh . '.mp3';

				$id = $this->_model->saveItem($this->_arrParam, array('task' => $task));

				//if($this->_arrParam['type'] == 'save-close') 	URL::redirect(URL::createLink('admin', 'song', 'index'));
				//if($this->_arrParam['type'] == 'save-new') 		URL::redirect(URL::createLink('admin', 'mv', 'form', array('idbh' => $this->_arrParam['idbh'])));
				if($this->_arrParam['type'] == 'save') 			URL::redirect(URL::createLink('admin', 'song', 'showInfo', array('idbh' => $id)));
			}

			////$this->_model->saveItem($this->_arrParam, array('task' => 'save'));
			$this->_view->arrParam = $this->_arrParam;
		}

		$this->_view->appendCSS(array('song/css/checkbox-label.css','song/css/style.css','song/css/form.css'));
		$this->_view->appendJS(array('song/js/jquery.min.js','song/js/bootstrap.min.js','song/js/custom.js'));
		$this->_view->render('song/form');
	}

	//AJAX-STATUS
	public function ajaxStatusAction(){
		$result = $this->_model->changeStatus($this->_arrParam, array('task'=>'change-ajax-status'));
		echo json_encode($result);
	}

	//STATUS_ACTION
	public function statusAction(){
		$this->_model->changeStatus($this->_arrParam, array('task'=>'change-status'));
		URL::redirect(URL::createLink('admin', 'song', 'index'));
	}

	//DELETE ACTION
	public function deleteAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'song', 'index'));
	}

	//INFO ACTION
	public function showInfoAction(){
		$this->_view->_title = 'Chi tiết bài hát';
		$this->_view->appendCSS(array('song/css/checkbox-label.css','song/css/style.css','song/css/info.css'));
		$this->_view->appendJS(array('song/js/jquery.min.js','song/js/bootstrap.min.js','song/js/custom.js'));
		$idbh = $this->_arrParam['idbh'];
		$this->_view->info = $this->_model->showInfoItems($idbh);	
		$this->_view->linkEdit       = URL::createLink('admin', 'song', 'form', array('idbh' => $idbh));
		$this->_view->render('song/songInfo');
	}

	

}