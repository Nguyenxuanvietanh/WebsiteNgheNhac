<?php
class UserController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function indexAction(){
		$this->_view->userInfo = $_SESSION['user'];
		$this->_view->_title = 'Manage  User';
		$totalItems = $this->_model->countUser($this->_arrParam);
		$configPagination = array('totalItemsPerPage' => 5, 'pageRange' => 5);
		$this->setPagination($configPagination);
		$this->_view->pagination = new Pagination($totalItems, $this->_pagination);
		$this->_view->users = $this->_model->userList($this->_arrParam);
		$this->_view->appendCSS(array('user/css/checkbox-label.css', 'user/css/style.css'));
		$this->_view->render('user/manager');
	}

	public function upgradeAction(){
		$this->_model->upgrade($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'user', 'index'));
	}

	public function downgradeAction(){
		$this->_model->downgrade($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'user', 'index'));
	}


	//DELETE ACTION
	public function deleteAction(){
		$this->_model->deleteItems($this->_arrParam);
		URL::redirect(URL::createLink('admin', 'user', 'index'));
	}
}