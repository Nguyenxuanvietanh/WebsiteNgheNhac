<?php
class UserController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function indexAction(){
		
	}
	
	public function loginAction(){
		if(isset($_POST['submit'])){
			$dataUser = $this->_model->login($_POST);
			if(empty($dataUser)){
				$this->_view->errors = '<span class="error">Username hoặc Password không đúng !</span>';
			}else{
				Session::set('loggedIn', true);
				Session::set('user', $dataUser);
				$_SESSION['name'] = $dataUser['name'];

				URL::redirect('index.php?module=default&controller=index&action=index');
			}
		}
		$this->_view->appendCSS(array('user/css/login.css'));
		$this->_view->render('user/login', true);
	}

	public function infoAction(){
		$id = $this->_arrParam['iduser'];
		$this->_view->songCabinet = $this->_model->songCabinet($id);
		$this->_view->mvCabinet = $this->_model->mvCabinet($id);
		$this->_view->suggests = $this->_model->suggests();
		if(isset($_POST['btnUpdate'])){
			$source = array('email' => $_POST['email'], 'phone'=>$_POST['phone']);
			$validate = new Validate($source);
			$validate->addRule('email', 'email');
					//  ->addRule('phone', 'phone');
			$validate->run();
			
			$data = $validate->getResult();

			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}else{
				$user = $this->_model->updateInfo($data);

				$_SESSION['user']['email'] = $user['email'];
				$_SESSION['user']['phone'] = $user['phone'];
				Session::set('message', array('class' => 'success', 'content' => ' Cập nhật thông tin thành công !'));
				URL::redirect(URL::createLink('default', 'user', 'info', array('iduser' => $this->_arrParam['iduser'])));
			}
			
		}

		$this->_view->appendCSS(array('user/css/info.css'));
		$this->_view->render('user/info', true);
	}
	
	public function logoutAction(){
		unset($_SESSION['loggedIn']);
		unset($_SESSION['user']);
		URL::redirect('index.php');
	}

	public function registerAction(){
		if(isset($_POST['submit'])){
			$this->_arrParam['form']['image'] = $_FILES['form']['name']['image'];
			$validate = new Validate($this->_arrParam['form']);
			$validate->addRule('username', 'string', array('min' => 1, 'max' => 50))
					 ->addRule('password', 'password')
					 ->addRule('re-password', 're-password', $this->_arrParam['form']['password'])
					 ->addRule('name', 'string', array('min' => 1, 'max' => 255))
					 //->addRule('phone', 'phone');
					 ->addRule('image', 'file', array('extension' => array('png','gif','jpg','jpeg')));
			$validate->run();
			$this->_arrParam['form'] = $validate->getResult();
			if($validate->isValid() == false){
				$this->_view->errors = $validate->showErrors();
			}
			else{
				$user_name = strtolower(Helper::convert_vi_to_en($this->_arrParam['form']['name'])) . time();
				$target_dir = PUBLIC_PATH ."images/users/";
				$target_file = $target_dir . basename($_FILES["form"]["name"]["image"]);
   				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$name = $user_name . '.' . $imageFileType;
				$image_base64 = base64_encode(file_get_contents($_FILES['form']['tmp_name']['image']) );
				$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
				move_uploaded_file($_FILES['form']['tmp_name']['image'],$target_dir.$name);

				$this->_arrParam['form']['image'] = $name;
				$data = $this->_model->register($this->_arrParam['form']);

				if($data){
					Session::set('message', array('class' => 'success', 'content' => ' Đăng ký thành công !'));
					URL::redirect(URL::createLink('default', 'user', 'login'));
				}else{
					Session::set('message', array('class' => 'error', 'content' => ' Đăng ký thất bại !'));
				}
			}
		}

		$this->_view->appendCSS(array('user/css/login.css'));
		$this->_view->render('user/register', true);
	}

	public function changePasswordAction(){
		$iduser = $this->_arrParam['iduser'];
		$dataUser = $this->_model->dataUser($iduser);
		$this->_view->dataUser = $dataUser;
		if(isset($_POST['submit'])){
			$validate = new Validate($this->_arrParam['form']);
			if(md5($this->_arrParam['form']['password']) != $dataUser['password']){
				$this->_view->errors = '<i style="color: red;">Mật khẩu hiện tại không đúng !</i>';
			}else{
				$validate->addRule('confirm-password', 're-password', $this->_arrParam['form']['new-password']);
				$validate->run();

				$this->_arrParam['form'] = $validate->getResult();
				if($validate->isValid() == false){
					$this->_view->errors = $validate->showErrors();
				}
				else{
					$this->_model->changePassWord($iduser, md5($this->_arrParam['form']['new-password']));
					unset($_SESSION['loggedIn']);
					unset($_SESSION['user']);
					Session::set('message', array('class' => 'success', 'content' => 'Đổi mật khẩu thành công. Mời đăng nhập lại !'));
					URL::redirect(URL::createLink('default', 'user', 'login'));
				}
			}
			
		}
		$this->_view->appendCSS(array('user/css/login.css'));
		$this->_view->render('user/changepassword', true);
	}
}