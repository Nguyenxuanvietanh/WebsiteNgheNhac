<?php
class AlbumController extends Controller{
	public function __construct($arrParams){
        parent::__construct($arrParams);
        $this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
    public function albumAction(){
		$this->_view->arrParam = $this->_arrParam;
		$idalbum = $this->_arrParam['idalbum'];
		$this->_view->album = $this->_model->albumInfo($idalbum);
		$idchude = $this->_model->idChude($idalbum);
		$this->_view->suggests  = $this->_model->suggestList(array('idchude'=>$idchude, 'idalbum'=>$idalbum));
		$idcasy = $this->_view->album[0]['idcasy'];
		$this->_view->singerAlbum = $this->_model->singerAlbum(array('idcasy'=>$idcasy, 'idalbum'=>$idalbum));
		$this->_view->singerMV = $this->_model->singerMV(array('idcasy'=>$idcasy));
		$this->_view->appendJS(array('album/js/album.js'));
        $this->_view->appendCSS(array('album/css/album.css'));
		$this->_view->render('album/album', true);
	}
	
	public function indexAction(){
		$this->_view->arrParam = $this->_arrParam;
		if(isset($this->_arrParam['idtheloai'])){
			$idtheloai = $this->_arrParam['idtheloai'];
			$this->_view->title = $this->_model->showTitle(array('idtheloai'=>$idtheloai));
			$this->_view->listAlbum = $this->_model->listAlbum(array('idtheloai'=>$idtheloai));
		}else if(isset($this->_arrParam['idchude'])){
			$idchude = $this->_arrParam['idchude'];
			$this->_view->title = $this->_model->showTitle(array('idchude'=>$idchude));
			$this->_view->listAlbum = $this->_model->listAlbum(array('idchude'=>$idchude));
		}else{
			$arrAlbum = array();
			$countNation = $this->_model->countNation();
			for($i = 1; $i <= $countNation; $i++){
				array_push($arrAlbum, $this->_model->listDefault($i));
			}
			$this->_view->listAlbum = $arrAlbum;
			$this->_view->quocgias = $this->_model->nationName();
		}
		$this->_view->listTheloai = $this->_model->listTheloai();
		$this->_view->listChude = $this->_model->listChude();
		$this->_view->appendCSS(array('album/css/listalbum.css'));
		$this->_view->render('album/listalbum', true);
	}
}