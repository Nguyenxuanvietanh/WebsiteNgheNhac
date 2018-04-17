<?php
class IndexController extends Controller{
	public function __construct($arrParams){
		parent::__construct($arrParams);
		
	}
	
	public function indexAction(){
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
		$this->_view->_title = 'Admin Home';
		$this->_view->appendCSS(array('index/css/style.css'));
		$this->_view->render('index/admin');
	}
	
	public function loginAction(){
		if(isset($_POST['submit'])){
			$dataUser = $this->_model->login($_POST);
			if(empty($dataUser)){
				$this->_view->errors = '<span class="error">Username hoặc Password không đúng !</span>';
			}else{
				if($dataUser['idloaiuser'] == 1 || $dataUser['idloaiuser'] == 2){
					Session::set('loggedIn', true);
					Session::set('user', $dataUser);
					$_SESSION['name'] = $dataUser['name'];

					URL::redirect('index.php?module=admin&controller=index&action=index');
				}else{
					$this->_view->errors = '<span class="error">Bạn không có quyền truy cập !</span>';
				}
			}
		}

		$this->_view->appendCSS(array('index/css/login.css','index/css/font-awesome.css'));
		$this->_view->render('index/login', false);
	}
	
	public function logoutAction(){
		unset($_SESSION['loggedIn']);
		unset($_SESSION['user']);
		URL::redirect('index.php?module=admin');
	}

}