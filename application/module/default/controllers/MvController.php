<?php
class MvController extends Controller{
	
	public function __construct($arrParams){
        parent::__construct($arrParams);
        $this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function MvAction(){
		$idmv = $this->_arrParam['idmv'];
		$this->_view->data = $this->_model->playVideo($idmv);
		$idcasy = $this->_view->data['idcasy'];
		$idchude = $this->_view->data['idchude'];
		$this->_view->albums = $this->_model->singerAlbum($idcasy);
		$this->_view->videos = $this->_model->singerMV($idcasy);
		$this->_view->suggests = $this->_model->suggestList(array('idchude'=>$idchude, 'idmv'=>$idmv));
        $this->_view->appendJS(array('mv/js/video-player.js'));
		$this->_view->appendCSS(array('mv/css/mv.css'));
		$this->_view->render('mv/mv', true);
	}

	public function indexAction(){
		$this->_view->arrParam = $this->_arrParam;
		if(isset($this->_arrParam['idtheloai'])){
			$idtheloai = $this->_arrParam['idtheloai'];
			$this->_view->title = $this->_model->showTitle(array('idtheloai'=>$idtheloai));
			$this->_view->listMV = $this->_model->mvList(array('idtheloai'=>$idtheloai));
		}else if(isset($this->_arrParam['idchude'])){
			$idchude = $this->_arrParam['idchude'];
			$this->_view->title = $this->_model->showTitle(array('idchude'=>$idchude));
			$this->_view->listMV = $this->_model->mvList(array('idchude'=>$idchude));
		}else{
			$arrMV = array();
			$countNation = $this->_model->countNation();
			for($i = 1; $i <= $countNation; $i++){
				array_push($arrMV, $this->_model->listDefault($i));
			}
			$this->_view->listMV = $arrMV;
			$this->_view->quocgias = $this->_model->nationName();
		}
		$this->_view->listTheloai = $this->_model->listTheloai();
		$this->_view->listChude = $this->_model->listChude();
		$this->_view->appendCSS(array('mv/css/listmv.css'));
		$this->_view->render('mv/listmv', true);
	}
	
}

?>