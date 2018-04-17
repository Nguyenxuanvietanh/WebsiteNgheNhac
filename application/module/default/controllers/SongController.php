<?php
class SongController extends Controller{
	
	public function __construct($arrParams){
        parent::__construct($arrParams);
        $this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function songAction(){
        if(isset($this->_arrParam['mess'])){
            if($this->_arrParam['mess'] == 'exist'){
                echo '<script type="text/javascript">alert("Bài hát đã có trong kho nhạc của bạn !");</script>';
            }else{
                echo '<script type="text/javascript">alert("Thêm bài hát vào tủ thành công !");</script>';
            }
        }
        $this->_view->arrParam = $this->_arrParam;
        $idbaihat = $this->_arrParam['idbaihat'];
        $casy     = $this->_model->singerID($idbaihat);
        $idcasy   = $casy['idcasy'];
        $idchude  = $this->_model->idChude($idbaihat);
        $this->_view->songPath = PUBLIC_PATH . 'mp3/';
        $this->_view->songData = $this->_model->songInfo($idbaihat);
        $this->_view->albums   = $this->_model->albumList($idcasy);
        $this->_view->videos   = $this->_model->videoList($idcasy);
        $this->_view->suggests  = $this->_model->suggestList(array('idchude'=>$idchude, 'idbaihat'=>$idbaihat));
        $this->_view->currentMV = $this->_model->currentMV($idbaihat);
        $this->_view->appendJS(array('song/js/nghenhac.js'));
		$this->_view->appendCSS(array('song/css/nghenhac.css'));
		$this->_view->render('song/nghenhac', true);
    }
    
    public function listSongAction(){
        $this->_view->arrParam = $this->_arrParam;
        if(isset($this->_arrParam['idtheloai'])){
            $id = $this->_arrParam['idtheloai'];
            $this->_view->title = $this->_model->showTitle(array('idtheloai'=>$id));
            $this->_view->listSong = $this->_model->listSong(array('idtheloai'=>$id));
            $this->_view->suggestList = $this->_model->suggestSubjectList(array('idtheloai'=>$id));
        }
        if(isset($this->_arrParam['idchude'])){
            $id = $this->_arrParam['idchude'];
            $this->_view->title = $this->_model->showTitle(array('idchude'=>$id));
            $this->_view->listSong = $this->_model->listSong(array('idchude'=>$id));
            $this->_view->suggestList = $this->_model->suggestSubjectList(array('idchude'=>$id));
        }
        $this->_view->appendCSS(array('song/css/listsong.css'));
		$this->_view->render('song/listsong', true);
    }

    public function downloadAction(){
        $this->_view->fileName = $this->_arrParam['file'];
        $this->_view->filePath = PUBLIC_PATH . 'mp3/';
        $this->_view->render('song/download', true);
    }
    
    public function songCabinetAction(){
        $idbh = $this->_arrParam['idbaihat'];
        $login = $this->checkLogin();
        if($login){
            $iduser = $_SESSION['user']['iduser'];
            $this->_model->addSongCabinet(array('idbaihat'=>$idbh, 'iduser'=>$iduser));
        }else{
            $login = URL::createLink('default', 'user', 'login');
            $link  = URL::createLink('default', 'song', 'song', array('idbaihat'=>$idbh));
            echo '<script type="text/javascript">
                    var r = confirm("Bạn cần đăng nhập để sử dụng chức năng này !");
                    if (r == true) {
                        console.log("You pressed OK!");
                        window.location.href = "'.$login.'";
                    } else {
                        console.log("You pressed Cancel!");
                        window.location.href = "'.$link.'";
                    }
                </script>';
        }
        
    }
}

?>