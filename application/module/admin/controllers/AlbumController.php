<?php
class AlbumController extends Controller{
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
        $this->_view->_title = 'Manage  Albums';
        $totalItems = $this->_model->countAlbum($this->_arrParam);
		$configPagination = array('totalItemsPerPage' => 5, 'pageRange' => 5);
		$this->setPagination($configPagination);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);
        $this->_view->albumItems = $this->_model->listAlbum($this->_arrParam);
        $this->_view->appendCSS(array('album/css/checkbox-label.css', 'album/css/style.css'));
		$this->_view->render('album/index');
	}
	
	//FORM ACTION
	public function formAction(){
		$this->_view->_title = 'Thêm Album';
		if(isset($this->_arrParam['idalbum'])){
			$this->_view->_title = 'Sửa thông tin Album';
			$this->_view->arrParam['form'] = $this->_model->showInfoItems($this->_arrParam['idalbum']);
			if(empty($this->_view->arrParam['form'])) URL::redirect(URL::createLink('admin', 'song', 'index'));
		}
		
		$this->_view->casy 	 	= $this->_model->dataRow('casy', 'tencasy', 'idcasy');
		$this->_view->quocgia	= $this->_model->dataRow('quocgia', 'tenquocgia', 'idquocgia');
		$this->_view->theloai	= $this->_model->dataRow('theloai', 'tentheloai', 'idtheloai');
		$this->_view->chude		= $this->_model->dataRow('chude', 'tenchude', 'idchude');

		if(!isset($this->_arrParam['form'])){
			$this->_arrParam['form']['token'] = '';
		}

		
		if($this->_arrParam['form']['token'] > 0){
			$this->_arrParam['form']['hinhanh'] = $_FILES['form']['name']['hinhanh'];

			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('tenalbum', 'string', array('min' => 1, 'max' => 255))
					 ->addRule('hinhanh', 'file', array('extension' => array('png','gif','jpg','jpeg')))
					 ->addRule('infoalbum', 'string', array('min' => 1, 'max' => 1000))
					 ->addRule('idtheloai', 'status', array('deny' => array('0')))
					 ->addRule('idcasy', 'status', array('deny' => array('0')));
			$validate->run();

			$this->_arrParam['form'] = $validate->getResult();
			
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}
			else{

				$task	= (isset($this->_arrParam['form']['idalbum'])) ? 'edit' : 'add';

				$ten_album = strtolower(Helper::convert_vi_to_en($this->_arrParam['form']['tenalbum'])) . time();
				
				$target_dir = PUBLIC_PATH ."images/albums/";
				$target_file = $target_dir . basename($_FILES["form"]["name"]["hinhanh"]);
   				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$name = $ten_album . '.' . $imageFileType;
				$image_base64 = base64_encode(file_get_contents($_FILES['form']['tmp_name']['hinhanh']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				move_uploaded_file($_FILES['form']['tmp_name']['hinhanh'],$target_dir.$name);


				$this->_arrParam['form']['hinhanh'] = $ten_album .'.'. $imageFileType;


				$this->_model->saveItem($this->_arrParam, array('task' => $task));

				if($this->_arrParam['type'] == 'save') 			URL::redirect(URL::createLink('admin', 'album', 'index'));
			}

			////$this->_model->saveItem($this->_arrParam, array('task' => 'save'));
			$this->_view->arrParam = $this->_arrParam;
		}

		$this->_view->appendCSS(array('song/css/checkbox-label.css','song/css/style.css','song/css/form.css'));
		$this->_view->appendJS(array('song/js/jquery.min.js','song/js/bootstrap.min.js','song/js/custom.js'));
		$this->_view->render('album/form');
	}
	
	//AJAX-STATUS
	public function ajaxStatusAction(){
		$result = $this->_model->changeStatus($this->_arrParam, array('task'=>'change-ajax-status'));
		echo json_encode($result);
	}

	//STATUS_ACTION
	public function statusAction(){
		$this->_model->changeStatus($this->_arrParam, array('task'=>'change-status'));
		URL::redirect(URL::createLink('admin', 'album', 'index'));
	}

	//DELETE ACTION
	public function deleteAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'album', 'index'));
	}

}