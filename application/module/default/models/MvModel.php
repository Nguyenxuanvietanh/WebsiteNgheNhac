<?php
class MvModel extends Model{
	public function __construct(){
		parent::__construct();
	}

	public function playVideo($id){
		$cs = "`casy`.`idcasy`,`casy`.`tencasy`, `casy`.`hinhanh` as `img-casy`, `casy`.`infocasy`, `casy`.`luotquantam`";
		$query[] = "SELECT `mv`.`linkvideo`, `mv`.`luotxem`, `mv`.`luotthich`, `baihat`.`tenbh`, `chitietbaihat`.`lyrics`, `album`.`tenalbum`, ".$cs.", `theloai`.`tentheloai`, `theloai`.`idtheloai`, `chude`.`idchude`";
		$query[] = "FROM `mv`, `baihat`, `casy`, `theloai`, `album`, `chitietbaihat`, `chude`";
		$query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat` ";
		$query[] = "AND `baihat`.`idbaihat` = `chitietbaihat`.`idbaihat` ";
		$query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy` ";
		$query[] = "AND `baihat`.`idalbum` = `album`.`idalbum` ";
        $query[] = "AND `baihat`.`idtheloai` = `theloai`.`idtheloai` ";
        $query[] = "AND `baihat`.`idchude` = `chude`.`idchude` ";
		$query[] = "AND `mv`.`idmv` = " . $id;

		$query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result;
	}

    //Index 
	public function listDefault($id){
		$query[] = "SELECT `mv`.`idmv`, `baihat`.`tenbh`, `mv`.`hinhanh`, `casy`.`tencasy`, `casy`.`idcasy`, `quocgia`.`tenquocgia`";
		$query[] = "FROM `mv`, `baihat`, `casy`, `quocgia`";
        $query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
		$query[] = "AND `baihat`.`idquocgia` = `quocgia`.`idquocgia`";
		$query[] = "AND `baihat`.`idquocgia` = " . $id;
		$query[] = "ORDER BY `mv`.`luotxem` DESC";
		$query[] = "LIMIT 0, 8";

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
    }
    //Category or Subject
    public function mvList($arrParam){
		$query[] = "SELECT `mv`.`idmv`, `baihat`.`tenbh`, `mv`.`hinhanh`, `casy`.`tencasy`, `casy`.`idcasy`";
		$query[] = "FROM `mv`, `baihat`, `casy`";
        $query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";

		if(isset($arrParam['idtheloai'])){
			$query[] = "AND `baihat`.`idtheloai` = " . $arrParam['idtheloai'];
		}

		if(isset($arrParam['idchude'])){
			$query[] = "AND `baihat`.`idchude` = " . $arrParam['idchude'];
		}
		

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}
    //Singer's mv list
	public function singerAlbum($id){
		$query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`, `album`.`hinhanh`, `casy`.`tencasy`";
        $query[] = "FROM `album`, `casy`";
        $query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `casy`.`idcasy` = " .$id;

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
	}
    //Singer's mv list
	public function singerMV($id){
        $query[] = "SELECT `mv`.`idmv`, `mv`.`hinhanh`, `baihat`.`tenbh`, `casy`.`tencasy`";
        $query[] = "FROM `mv`, `baihat`, `casy`";
        $query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `casy`.`idcasy` = " .$id;

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
	}
	//Suggest List
	public function suggestList($arrParam){
        $query[] = "SELECT `mv`.`idmv`, `baihat`.`tenbh`, `mv`.`hinhanh`, `mv`.`linkvideo` , `casy`.`tencasy`";
        $query[] = "FROM `mv`, `baihat`, `casy`";
		$query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
		$query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `baihat`.`idchude` = " .$arrParam['idchude'];
        $query[] = "AND `mv`.`idmv` != " .$arrParam['idmv'];
        $query[] = "LIMIT 10";

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

}
?>