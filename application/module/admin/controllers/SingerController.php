<?php
class SingerController extends Controller{
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
        $this->_view->_title = 'Manage  Singers';
        $totalItems = $this->_model->countSinger($this->_arrParam);
		$configPagination = array('totalItemsPerPage' => 5, 'pageRange' => 5);
		$this->setPagination($configPagination);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);
        $this->_view->singerItems = $this->_model->listSinger($this->_arrParam);
        $this->_view->appendCSS(array('singer/css/checkbox-label.css', 'singer/css/style.css'));
		$this->_view->render('singer/index');
    }

    public function formAction(){
		$this->_view->_title = 'Add Singer';
		$albumCondition = '';
		$this->_view->quocgia	= $this->_model->dataRow('quocgia', 'tenquocgia', 'idquocgia');
		
		if(isset($this->_arrParam['idcasy'])){
			$this->_view->_title = 'Update Singer';
			$this->_view->arrParam['form'] = $this->_model->showInfoItems($this->_arrParam['idcasy']);
			if(empty($this->_view->arrParam['form'])) URL::redirect(URL::createLink('admin', 'singer', 'index'));
        }

        if(!isset($this->_arrParam['form'])){
			$this->_arrParam['form']['token'] = '';
        }

        if($this->_arrParam['form']['token'] > 0){
			$this->_arrParam['form']['hinhanh'] = $_FILES['form']['name']['hinhanh'];

			$validate = new Validate($this->_arrParam['form']);

			$validate->addRule('tencasy', 'string', array('min' => 1, 'max' => 255))
					 ->addRule('hinhanh', 'file', array('extension' => array('png','gif','jpg','jpeg')))
					 ->addRule('infocasy', 'string', array('min' => 1, 'max' => 1000));
			$validate->run();

			$this->_arrParam['form'] = $validate->getResult();
			
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}
			else{

				$task	= (isset($this->_arrParam['form']['idcasy'])) ? 'edit' : 'add';

				$ten_casy = strtolower(Helper::convert_vi_to_en($this->_arrParam['form']['tencasy'])) . time();
				
				$target_dir = PUBLIC_PATH ."images/singers/";
				$target_file = $target_dir . basename($_FILES["form"]["name"]["hinhanh"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $name = $ten_casy . '.' . $imageFileType;
				$image_base64 = base64_encode(file_get_contents($_FILES['form']['tmp_name']['hinhanh']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				move_uploaded_file($_FILES['form']['tmp_name']['hinhanh'],$target_dir.$name);

                $this->_arrParam['form']['hinhanh'] = $ten_casy .'.'. $imageFileType;

				$id = $this->_model->saveItem($this->_arrParam, array('task' => $task));

				if($this->_arrParam['type'] == 'save') 			URL::redirect(URL::createLink('admin', 'singer', 'index'));
			}
			$this->_view->arrParam = $this->_arrParam;
		}
		

		$this->_view->appendCSS(array('singer/css/checkbox-label.css','singer/css/style.css','singer/css/form.css'));
		$this->_view->appendJS(array('singer/js/jquery.min.js','singer/js/bootstrap.min.js','singer/js/custom.js'));
		$this->_view->render('singer/form');
    }
    
    //DELETE ACTION
	public function deleteAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'singer', 'index'));
	}

}