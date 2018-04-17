<?php
class MvController extends Controller{
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
    }
    
    public function indexAction(){
        $this->_view->_title = 'Manage MV';
        $totalItems = $this->_model->countMv($this->_arrParam);
		$configPagination = array('totalItemsPerPage' => 5, 'pageRange' => 5);
		$this->setPagination($configPagination);
        $this->_view->mvs = $this->_model->mvList($this->_arrParam);
        $this->_view->appendCSS(array('mv/css/checkbox-label.css','mv/css/style.css'));
		$this->_view->appendJS(array('mv/js/jquery.min.js','mv/js/bootstrap.min.js','mv/js/custom.js'));
		$this->_view->render('mv/mv');
    }
	
	public function formAction(){
        $this->_view->_title = 'Thêm MV';
        $idbaihat = (isset($this->_arrParam['idbaihat'])) ? $this->_arrParam['idbaihat'] : '';
        $this->_view->arrParam['form'] = $this->_model->showSongName($idbaihat);
        if(isset($this->_arrParam['idmv'])){
			$this->_view->_title = 'Sửa thông tin MV';
            $this->_view->arrParam['form'] = $this->_model->showInfoItems($this->_arrParam['idmv']);
			if(empty($this->_view->arrParam['form'])) URL::redirect(URL::createLink('admin', 'mv', 'index'));
        }
        if(!isset($this->_arrParam['form'])){
			$this->_arrParam['form']['token'] = '';
		}
        if($this->_arrParam['form']['token'] > 0){
			$this->_arrParam['form']['hinhanh'] = $_FILES['form']['name']['hinhanh'];
			$this->_arrParam['form']['video'] = $_FILES['form']['name']['video'];

			$validate = new Validate($this->_arrParam['form']);
			
			$validate->addRule('hinhanh', 'file', array('extension' => array('png','gif','jpg','jpeg')))
					 ->addRule('video', 'file', array('extension' => array('mp4')))
					 ->addRule('infomv', 'string', array('min' => 1, 'max' => 1000));
			$validate->run();

			$this->_arrParam['form'] = $validate->getResult();
			
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}
			else{

				$task	= (isset($this->_arrParam['form']['idmv'])) ? 'edit' : 'add';

				$ten_mv = strtolower(Helper::convert_vi_to_en($this->_arrParam['form']['tenbh'])) . time();
				
				$target_dir = PUBLIC_PATH ."images/mv/";
				$target_file = $target_dir . basename($_FILES["form"]["name"]["hinhanh"]);
   				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$name = $ten_mv . '.' . $imageFileType;
				$image_base64 = base64_encode(file_get_contents($_FILES['form']['tmp_name']['hinhanh']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				move_uploaded_file($_FILES['form']['tmp_name']['hinhanh'],$target_dir.$name);

				$target_dirmp4 = PUBLIC_PATH ."mvs/";
				$mp4_name = $ten_mv . '.mp4';
				move_uploaded_file($_FILES['form']['tmp_name']['video'],$target_dirmp4.$mp4_name);

				$this->_arrParam['form']['hinhanh'] = $ten_mv .'.'. $imageFileType;
				$this->_arrParam['form']['video']	= $ten_mv . '.mp4';

                $this->_model->saveItem($this->_arrParam, array('task' => $task));

                if($this->_arrParam['type'] == 'save') 			URL::redirect(URL::createLink('admin', 'mv', 'index'));
			}

			////$this->_model->saveItem($this->_arrParam, array('task' => 'save'));
			$this->_view->arrParam = $this->_arrParam;
        }
        
        $this->_view->appendCSS(array('mv/css/checkbox-label.css','mv/css/style.css','mv/css/form.css'));
		$this->_view->appendJS(array('mv/js/jquery.min.js','mv/js/bootstrap.min.js','mv/js/custom.js'));
		$this->_view->render('mv/form');
    }

    //AJAX-STATUS
	public function ajaxStatusAction(){
		$result = $this->_model->changeStatus($this->_arrParam, array('task'=>'change-ajax-status'));
		echo json_encode($result);
	}

	//STATUS_ACTION
	public function statusAction(){
		$this->_model->changeStatus($this->_arrParam, array('task'=>'change-status'));
		URL::redirect(URL::createLink('admin', 'mv', 'index'));
	}

	//DELETE ACTION
	public function deleteAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'mv', 'index'));
	}

}