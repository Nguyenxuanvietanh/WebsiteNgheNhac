<?php
class SongModel extends Model{
	public function __construct(){
		parent::__construct();
    }
    
    public function songInfo($id){
        $query[] = "SELECT  `baihat`.`idbaihat`, `baihat`.`tenbh`, `casy`.`tencasy`, `casy`.`hinhanh` as `img-casy`, `casy`.`infocasy`, `casy`.`luotquantam`, ";
        $query[] = "`chitietbaihat`.`mp3`, `chitietbaihat`.`hinhanhct`, `chitietbaihat`.`luotthich`, `chitietbaihat`.`luotnghe`, `chitietbaihat`.`lyrics`,";
        $query[] = "`nghesy`.`tennghesy`, `album`.`tenalbum`, `theloai`.`idtheloai`,`theloai`.`tentheloai` ";
        $query[] = "FROM `baihat`, `casy`, `chitietbaihat`, `nghesy`, `album`, `theloai`";
        $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `baihat`.`idbaihat` = `chitietbaihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idnghesy` = `nghesy`.`idnghesy`";
        $query[] = "AND `baihat`.`idalbum`  = `album`.`idalbum`";
        $query[] = "AND `baihat`.`idtheloai` = `theloai`.`idtheloai`";
        $query[] = "AND `baihat`.`idbaihat` = " .$id;

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result;
    }

    public function singerID($id){
        $query[] = "SELECT `casy`.`idcasy`";
        $query[] = "FROM `baihat`, `casy`";
        $query[] = "WHERE `casy`.`idcasy` = `baihat`.`idcasy`";
        $query[] = "AND `baihat`.`idbaihat` = " .$id;

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result;
    }

    public function albumList($id){
        $query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`, `album`.`hinhanh`, `casy`.`tencasy`";
        $query[] = "FROM `album`, `casy`";
        $query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `casy`.`idcasy` = " .$id;

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function videoList($id){
        $query[] = "SELECT `mv`.`idmv`, `mv`.`hinhanh`, `baihat`.`tenbh`, `casy`.`tencasy`";
        $query[] = "FROM `mv`, `baihat`, `casy`";
        $query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `casy`.`idcasy` = " .$id;

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function idChude($id){
        $query[] = "SELECT `chude`.`idchude`";
        $query[] = "FROM `baihat`, `chude`";
        $query[] = "WHERE `chude`.`idchude` = `baihat`.`idchude`";
        $query[] = "AND `baihat`.`idbaihat` = " .$id;

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result['idchude'];
    }

    public function suggestList($arrParam){
        $query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `casy`.`hinhanh`, `casy`.`tencasy`, `chitietbaihat`.`mp3`";
        $query[] = "FROM `baihat`, `casy`, `chitietbaihat`";
        $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `chitietbaihat`.`idbaihat` = `baihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idchude` = " .$arrParam['idchude'];
        $query[] = "AND `baihat`.`idbaihat` != " .$arrParam['idbaihat'];
        $query[] = "LIMIT 10";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function listSong($arrParam){
        $query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `baihat`.`hinhanh`, `casy`.`idcasy`, `casy`.`tencasy`";
        $query[] = "FROM `baihat`, `casy`";
        $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";

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

    public function showTitle($arrParam){
        if(isset($arrParam['idtheloai'])){
            $query = "SELECT `idtheloai`, `tentheloai`, `hinhanh` FROM `theloai` WHERE `idtheloai` = " . $arrParam['idtheloai'];
        }

        if(isset($arrParam['idchude'])){
            $query = "SELECT `idchude`,`tenchude`, `hinhanh` FROM `chude` WHERE `idchude` = " . $arrParam['idchude'];
        }

        $result = $this->singleRecord($query);
        return $result;
    }

    public function suggestSubjectList($arrParam){
        if(isset($arrParam['idtheloai'])){
            $query[] = "SELECT `idtheloai` as `id`, `hinhanh`";
            $query[] = "FROM `theloai`";
            $query[] = "WHERE `idtheloai` != " . $arrParam['idtheloai'];
        }

        if(isset($arrParam['idchude'])){
            $query[] = "SELECT `idchude` as `id`, `hinhanh`";
            $query[] = "FROM `chude`";
            $query[] = "WHERE `idchude` != " . $arrParam['idchude'];
        }

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function currentMV($id){
        $query[] = "SELECT `mv`.`idmv`, `mv`.`hinhanh`, `baihat`.`tenbh`, `casy`.`tencasy`";
        $query[] = "FROM `mv`, `baihat`, `casy`";
        $query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `baihat`.`idbaihat` = " . $id;

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result;
    }

    public function addSongCabinet($arrParam){
        $idbaihat = $arrParam['idbaihat'];
        $iduser   = $arrParam['iduser'];
        $arrIDBH = array();
        $query = "SELECT `idbaihat` FROM `khonhac` WHERE `iduser` = " . $arrParam['iduser'];
        $arrSongid = $this->listRecord($query);
        foreach($arrSongid as $songId){
            array_push($arrIDBH, $songId['idbaihat']);
        }
        if(in_array($idbaihat, $arrIDBH)){
            $mess = 'exist';
        }else{
            $query = "INSERT INTO `khonhac`(`iduser`, `idbaihat`) VALUES (".$iduser.",".$idbaihat.")";
            $this->query($query);
            $mess = 'success';
        }
        URL::redirect(URL::createLink('default', 'song', 'song', array('idbaihat'=>$idbaihat, 'mess'=>$mess)));
    }
}
?>