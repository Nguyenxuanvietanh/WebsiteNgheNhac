<?php
class SingerModel extends Model{
	public function __construct(){
		parent::__construct();
    }
    
    public function singerInfo($id){
        $query[] = "SELECT * FROM `casy`";
        $query[] = "WHERE `idcasy` = " . $id;

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result;
    }

    public function singerList($id){
        $query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `baihat`.`hinhanh`, `casy`.`tencasy`";
        $query[] = "FROM `baihat`, `casy`";
        $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `baihat`.`idcasy` = " . $id;
        $query[] = "ORDER BY RAND() LIMIT 8";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function singerAlbum($id){
        $query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`, `album`.`hinhanh`, `casy`.`tencasy`";
        $query[] = "FROM `album`, `casy`";
        $query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `album`.`idcasy` = " . $id;
        $query[] = "ORDER BY RAND() LIMIT 8";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function singerMV($id){
        $query[] = "SELECT `mv`.`idmv`, `baihat`.`tenbh`, `mv`.`hinhanh`, `casy`.`tencasy`";
        $query[] = "FROM `mv`,`baihat`, `casy`";
        $query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `baihat`.`idcasy` = " . $id;
        $query[] = "ORDER BY RAND() LIMIT 8";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function singerSuggest($id){
        $query[] = "SELECT `idcasy`, `tencasy`, `hinhanh`, `luotquantam`";
        $query[] = "FROM `casy`";
        $query[] = "WHERE `idcasy` != " . $id;
        $query[] = "ORDER BY RAND() LIMIT 10";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function showNationName($id){
        $query = "SELECT `tenquocgia` FROM `quocgia` WHERE `idquocgia` = ". $id;
        $result = $this->singleRecord($query);
        return $result;
    }

    public function listSinger($id){
        $query[] = "SELECT `idcasy`, `tencasy`, `hinhanh`, `luotquantam`";
        $query[] = "FROM `casy`";
        $query[] = "WHERE `idquocgia` = ". $id;

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }
}
?>