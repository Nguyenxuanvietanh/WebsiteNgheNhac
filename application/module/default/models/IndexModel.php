<?php
class IndexModel extends Model{
	public function __construct(){
		parent::__construct();
    }
    
    public function showSongs($type = null){
        
        if($type == null){
            $query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `baihat`.`hinhanh`, `baihat`.`idcasy`, `casy`.`tencasy`";
            $query[] = "FROM `baihat`, `casy`";
            $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
            $query[] = "AND `baihat`.`dexuat` = 1";
            $query[] = "LIMIT 8";
        }

        if($type == 'new'){
            $query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `baihat`.`hinhanh`, `baihat`.`idcasy`, `casy`.`tencasy`, `chitietbaihat`.`mp3`";
            $query[] = "FROM `baihat`, `casy`, `chitietbaihat`";
            $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
            $query[] = "AND `baihat`.`idbaihat` = `chitietbaihat`.`idbaihat`";
            $query[] = "ORDER BY `baihat`.`ngayphathanh` DESC";
            $query[] = "LIMIT 5";
        }

        if($type == 'hot'){
            $query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `baihat`.`hinhanh`, `baihat`.`idcasy`, `casy`.`tencasy`, `chitietbaihat`.`luotnghe`, `chitietbaihat`.`mp3`";
            $query[] = "FROM `baihat`, `casy`, `chitietbaihat`";
            $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
            $query[] = "AND `baihat`.`idbaihat` = `chitietbaihat`.`idbaihat`";
            $query[] = "ORDER BY `chitietbaihat`.`luotthich` DESC";
            $query[] = "LIMIT 5";
        }     

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function showAlbums(){
        $query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`, `album`.`hinhanh`, `casy`.`tencasy`, `casy`.`idcasy`";
        $query[] = "FROM `album`, `casy`";
        $query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `album`.`dexuat` = 1";
        $query[] = "LIMIT 8";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function showVideos(){
        $query[] = "SELECT `mv`.`idmv`, `baihat`.`tenbh`, `mv`.`hinhanh`, `casy`.`tencasy`, `casy`.`idcasy`";
        $query[] = "FROM `mv`, `baihat`, `casy`";
        $query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
        $query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `mv`.`dexuat` = 1";
        $query[] = "LIMIT 8";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function showSingers(){
        $query[] = "SELECT `idcasy`, `hinhanh`, `tencasy`";
        $query[] = "FROM `casy`";
        $query[] = "ORDER BY `luotquantam` DESC";
        $query[] = "LIMIT 9";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function songsRate($param = null){
        $query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `baihat`.`idcasy`, `casy`.`tencasy`, `chitietbaihat`.`hinhanhct` as `img-chitiet`, `chitietbaihat`.`luotnghe`, `chitietbaihat`.`mp3`";
        $query[] = "FROM `baihat`, `casy`, `chitietbaihat`";
        $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `baihat`.`idbaihat` = `chitietbaihat`.`idbaihat`";
        if($param == 'vietnam'){
            $query[] = "AND `baihat`.`idquocgia` = 1";
        }

        if($param == 'hanquoc'){
            $query[] = "AND `baihat`.`idquocgia` = 2";
        }

        if($param == 'aumy'){
            $query[] = "AND `baihat`.`idquocgia` = 3";
        }
        $query[] = "ORDER BY `chitietbaihat`.`luotnghe` DESC";
        $query[] = "LIMIT 5";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function videosRate($param = null){
        $query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `baihat`.`idcasy`, `casy`.`tencasy`, `chitietbaihat`.`hinhanhct` as `img-chitiet`, `mv`.`idmv`, `mv`.`linkvideo`, `mv`.`luotxem`";
        $query[] = "FROM `baihat`, `casy`, `mv`, `chitietbaihat`";
        $query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
        $query[] = "AND `baihat`.`idbaihat` = `mv`.`idbaihat`";
        $query[] = "AND `baihat`.`idbaihat` = `chitietbaihat`.`idbaihat`";

        if($param == 'vietnam'){
            $query[] = "AND `baihat`.`idquocgia` = 1";
        }

        if($param == 'hanquoc'){
            $query[] = "AND `baihat`.`idquocgia` = 2";
        }

        if($param == 'aumy'){
            $query[] = "AND `baihat`.`idquocgia` = 3";
        }
        $query[] = "ORDER BY `mv`.`luotxem` DESC";
        $query[] = "LIMIT 5";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function topic(){
        $query[] = "SELECT `hinhanh`, `idchude`";
        $query[] = "FROM `chude`";
        $query[] = "ORDER BY RAND()";
        $query[] = "LIMIT 3";

        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

}