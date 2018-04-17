<?php
class MusicianController extends Controller{
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
        $this->_view->_title = 'Manage  Musicians';
        $totalItems = $this->_model->countMusician($this->_arrParam);
		$configPagination = array('totalItemsPerPage' => 5, 'pageRange' => 5);
		$this->setPagination($configPagination);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);
        $this->_view->musicianItems = $this->_model->listMusician($this->_arrParam);
        $this->_view->appendCSS(array('musician/css/checkbox-label.css', 'musician/css/style.css'));
		$this->_view->render('musician/index');
    }

    public function formAction(){
		$this->_view->_title = 'Thêm nhạc sỹ';
		$albumCondition = '';
		if(isset($this->_arrParam['idnghesy'])){
			$this->_view->_title = 'Sửa thông tin nhạc sỹ';
			$this->_view->arrParam['form'] = $this->_model->showInfoItems($this->_arrParam['idnghesy']);
			if(empty($this->_view->arrParam['form'])) URL::redirect(URL::createLink('admin', 'musician', 'index'));
        }

        if(!isset($this->_arrParam['form'])){
			$this->_arrParam['form']['token'] = '';
        }

        if($this->_arrParam['form']['token'] > 0){
			$this->_arrParam['form']['hinhanh'] = $_FILES['form']['name']['hinhanh'];

			$validate = new Validate($this->_arrParam['form']);

			$validate->addRule('tennghesy', 'string', array('min' => 1, 'max' => 255))
					 ->addRule('hinhanh', 'file', array('extension' => array('png','gif','jpg','jpeg')))
					 ->addRule('infonghesy', 'string', array('min' => 1, 'max' => 255));
			$validate->run();

			$this->_arrParam['form'] = $validate->getResult();
			
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}
			else{

				$task	= (isset($this->_arrParam['form']['idnghesy'])) ? 'edit' : 'add';

				$ten_ns = strtolower(Helper::convert_vi_to_en($this->_arrParam['form']['tennghesy'])) . time();
				
				$target_dir = PUBLIC_PATH ."images/musicians/";
				$target_file = $target_dir . basename($_FILES["form"]["name"]["hinhanh"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $name = $ten_ns . '.' . $imageFileType;
				$image_base64 = base64_encode(file_get_contents($_FILES['form']['tmp_name']['hinhanh']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				move_uploaded_file($_FILES['form']['tmp_name']['hinhanh'],$target_dir.$name);

                $this->_arrParam['form']['hinhanh'] = $ten_ns .'.'. $imageFileType;

				$id = $this->_model->saveItem($this->_arrParam, array('task' => $task));

				if($this->_arrParam['type'] == 'save') 			URL::redirect(URL::createLink('admin', 'musician', 'index'));
			}
			$this->_view->arrParam = $this->_arrParam;
		}
		

		$this->_view->appendCSS(array('musician/css/checkbox-label.css','musician/css/style.css','musician/css/form.css'));
		$this->_view->appendJS(array('musician/js/jquery.min.js','musician/js/bootstrap.min.js','musician/js/custom.js'));
		$this->_view->render('musician/form');
    }
    
    //DELETE ACTION
	public function deleteAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'musician', 'index'));
	}

}