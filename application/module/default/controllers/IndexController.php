<?php
class IndexController extends Controller{
	
	public function __construct($arrParams){
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}
	
	public function indexAction(){
		$this->_view->songs = $this->_model->showSongs();
		$this->_view->albums = $this->_model->showAlbums();
		$this->_view->videos = $this->_model->showVideos();
		$this->_view->newSongs = $this->_model->showSongs('new');
		$this->_view->hotSongs = $this->_model->showSongs('hot');
		$this->_view->hotSingers = $this->_model->showSingers();
		//Songs Rate
		$this->_view->vnSongsRates =  $this->_model->songsRate('vietnam');
		$this->_view->hqSongsRates =  $this->_model->songsRate('hanquoc');
		$this->_view->amSongsRates =  $this->_model->songsRate('aumy');
		//MVs Rate
		$this->_view->vnMvRates    = $this->_model->videosRate('vietnam');
		$this->_view->hqMvRates    = $this->_model->videosRate('hanquoc');
		$this->_view->amMvRates    = $this->_model->videosRate('aumy');

		$this->_view->topics	   = $this->_model->topic();

		$this->_view->appendJS(array('index/js/custom.js'));
		$this->_view->render('index/index', true);
	}
	
}