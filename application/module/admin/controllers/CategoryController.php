<?php
class CategoryController extends Controller{
	public function __construct($arrParams){
        parent::__construct($arrParams);
        $this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
    public function indexAction(){
        $this->_view->_title = 'Manage  Categories';

        $this->_view->arrParam = $this->_arrParam;
        if(isset($this->_arrParam['idtheloai'])){
            $this->_view->formData = $this->_model->Categories($this->_arrParam['idtheloai']);
        }
        $this->_view->categories = $this->_model->Categories();

        
        if(isset($this->_arrParam['form']['token']) && $this->_arrParam['form']['token'] > 0){
            $this->_arrParam['form']['hinhanh'] = $_FILES['form']['name']['hinhanh'];

            $validate = new Validate($this->_arrParam['form']);
			$validate->addRule('tentheloai', 'string', array('min' => 1, 'max' => 255))
					 ->addRule('hinhanh', 'file', array('extension' => array('png','gif','jpg','jpeg')));
			$validate->run();

			$this->_arrParam['form'] = $validate->getResult();
			
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}
			else{
                $task	= (isset($this->_arrParam['form']['idtheloai'])) ? 'edit' : 'add';

                $ten_theloai = strtolower(Helper::convert_vi_to_en($this->_arrParam['form']['tentheloai'])) . time();
                
                $target_dir = PUBLIC_PATH ."images/categories/";
				$target_file = $target_dir . basename($_FILES["form"]["name"]["hinhanh"]);
   				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$name = $ten_theloai . '.' . $imageFileType;
				$image_base64 = base64_encode(file_get_contents($_FILES['form']['tmp_name']['hinhanh']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				move_uploaded_file($_FILES['form']['tmp_name']['hinhanh'],$target_dir.$name);


				$this->_arrParam['form']['hinhanh'] = $ten_theloai .'.'. $imageFileType;


                $this->_model->saveItem($this->_arrParam, array('task' => $task));
                if($this->_arrParam['type'] == 'save') 			URL::redirect(URL::createLink('admin', 'category', 'index'));
            }
        }
        $this->_view->appendCSS(array('category/css/checkbox-label.css', 'category/css/form.css', 'category/css/category.css'));
		$this->_view->render('category/category', true);
    }
    
    //DELETE ACTION
	public function deleteAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'category', 'index'));
	}
	
}