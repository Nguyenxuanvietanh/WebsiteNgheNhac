<?php
class SingerController extends Controller{
	public function __construct($arrParams){
        parent::__construct($arrParams);
        $this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
    public function singerAction(){
        $idcasy = $this->_arrParam['idcasy'];
        $this->_view->singerInfo = $this->_model->singerInfo($idcasy);
        $this->_view->singerList = $this->_model->singerList($idcasy);
        $this->_view->singerAlbum = $this->_model->singerAlbum($idcasy);
        $this->_view->singerMV = $this->_model->singerMV($idcasy);
        $this->_view->singerSuggest = $this->_model->singerSuggest($idcasy);
        $this->_view->appendCSS(array('singer/css/singer.css'));
		$this->_view->render('singer/index', true);
    }
    
    public function listSingerAction(){
        $idquocgia = $this->_arrParam['idquocgia'];
        $this->_view->nationName = $this->_model->showNationName($idquocgia);
        $this->_view->listSinger = $this->_model->listSinger($idquocgia);
        $this->_view->appendCSS(array('singer/css/listsinger.css'));
		$this->_view->render('singer/listsinger', true);
    }
	
}