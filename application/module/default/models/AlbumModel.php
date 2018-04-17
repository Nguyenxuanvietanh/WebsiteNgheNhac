<?php
class AlbumModel extends Model{
	public function __construct(){
		parent::__construct();
	}

	public function albumInfo($id){
		$query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`,";
		$query[] = " `chitietbaihat`.`mp3`, `chitietbaihat`.`hinhanhct`, `chitietbaihat`.`luotthich`, `chitietbaihat`.`luotnghe`,`chitietbaihat`.`lyrics`,";
		$query[] = " `casy`.`idcasy`, `casy`.`tencasy`, `casy`.`hinhanh` as `img-casy`, `casy`.`infocasy`, `casy`.`luotquantam`";
		$query[] = "FROM `baihat`, `chitietbaihat`, `casy`";
		$query[] = "WHERE `baihat`.`idbaihat` = `chitietbaihat`.`idbaihat`";
		$query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy` ";
		$query[] = "AND `baihat`.`idalbum` = " . $id;

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
        return $result;
	}

	public function listAlbum($arrParam){
		$query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`, `album`.`hinhanh`, `casy`.`tencasy`, `casy`.`idcasy`";
		$query[] = "FROM `album`, `casy`";
		$query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";

		if(isset($arrParam['idtheloai'])){
			$query[] = "AND `album`.`idtheloai` = " . $arrParam['idtheloai'];
		}

		if(isset($arrParam['idchude'])){
			$query[] = "AND `album`.`idchude` = " . $arrParam['idchude'];
		}
		

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}

	public function listTheloai(){
		$query[] = "SELECT `idtheloai`, `tentheloai`";
		$query[] = "FROM `theloai`";
		
		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}

	public function listChude(){
		$query[] = "SELECT `idchude`, `tenchude`";
		$query[] = "FROM `chude`";
		
		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}

	public function idChude($id){
		$query[] = "SELECT `chude`.`idchude`";
        $query[] = "FROM `album`, `chude`";
        $query[] = "WHERE `chude`.`idchude` = `album`.`idchude`";
        $query[] = "AND `album`.`idalbum` = " .$id;

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result['idchude'];
	}
	//Index 
	public function listDefault($id){
		$query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`, `album`.`hinhanh`, `casy`.`tencasy`, `casy`.`idcasy`, `quocgia`.`tenquocgia`";
		$query[] = "FROM `album`, `casy`, `quocgia`";
		$query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";
		$query[] = "AND `album`.`idquocgia` = `quocgia`.`idquocgia`";
		$query[] = "AND `album`.`idquocgia` = " . $id;
		$query[] = "ORDER BY `album`.`luotnghe` DESC";
		$query[] = "LIMIT 0, 8";

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}
	//COUNT Nation
	public function countNation(){
        $query[] = 'SELECT COUNT(`idquocgia`) AS `total`';
        $query[] = 'FROM `quocgia`';

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result['total'];
	}
	//Nation Name
	public function nationName(){
		$query[] = "SELECT `idquocgia`,`tenquocgia`";
		$query[] = "FROM `quocgia`";

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}
	//Title
	public function showTitle($arrParam){
		if(isset($arrParam['idtheloai'])){
			$query[] = "SELECT `tentheloai` FROM `theloai` WHERE idtheloai = ". $arrParam['idtheloai'];
		}
		if(isset($arrParam['idchude'])){
			$query[] = "SELECT `tenchude` FROM `chude` WHERE idchude = ". $arrParam['idchude'];
		}

		$query = implode(" ", $query);
		$result = $this->singleRecord($query);
		return $result;
	}

	public function suggestList($arrParam){
        $query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`, `casy`.`hinhanh`, `casy`.`tencasy`";
        $query[] = "FROM `album`, `casy`";
        $query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `album`.`idchude` = " .$arrParam['idchude'];
        $query[] = "AND `album`.`idalbum` != " .$arrParam['idalbum'];
        $query[] = "LIMIT 10";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
	}
	//Singer's Albums
	public function singerAlbum($arrParam){
		$query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`,`album`.`hinhanh`, `album`.`idcasy`, `casy`.`tencasy`";
		$query[] = "FROM `album`, `casy`";
		$query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";
		$query[] = "AND `album`.`idcasy` = " . $arrParam['idcasy'];
		$query[] = "AND `album`.`idalbum` != " . $arrParam['idalbum'];
		$query[] = "LIMIT 8";

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}
	//Singer's MV
	public function singerMV($arrParam){
		$query[] = "SELECT `mv`.`idmv`, `baihat`.`tenbh`,`mv`.`hinhanh`, `baihat`.`idcasy`, `casy`.`tencasy`";
		$query[] = "FROM `mv`,`baihat`, `casy`";
		$query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
		$query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
		$query[] = "AND `baihat`.`idcasy` = " . $arrParam['idcasy'];
		$query[] = "LIMIT 8";

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}

}
?>