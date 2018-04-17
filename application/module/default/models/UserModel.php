<?php
class UserModel extends Model{
	public function __construct(){
		parent::__construct();
	}

	public function login($arrParam){
		$username 	= $arrParam['username'];
		$password 	= md5($arrParam['password']);

		$query[] 	= "SELECT * ";
		$query[] 	= "FROM `user`";
		$query[] 	= "WHERE `username` = '".$username."' AND `password` = '".$password."'";

		$query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result;
	}

	public function updateInfo($arrParam){
		$id = $_GET['iduser'];
		$email = $arrParam['email'];
		$phone = $arrParam['phone'];

		$query[] = "UPDATE user SET ";
		$query[] = "`email` = '" . $email . "', `phone` = '" . $phone . "'";
		$query[] = "WHERE `iduser` = " . $id;

		$query = implode(" ", $query);
		$this->query($query);

		$str = "SELECT * FROM `user` WHERE `iduser` = " . $id;
		$result = $this->singleRecord($str);
		return $result;
	}

	public function dataUser($id){
		$query = "SELECT `username`, `password` FROM `user` WHERE `iduser` = ". $id;
		$result = $this->singleRecord($query);
		return $result;
	}

	public function changePassWord($id, $password){
		$query[] = "UPDATE `user`";
		$query[] = "SET `password` = '" . $password . "'";
		$query[] = "WHERE `iduser` = " . $id;

		$query = implode(" ", $query);
		$this->query($query);
	}

	public function register($arrParam){
		$username = $arrParam['username'];
		$password = md5($arrParam['password']);
		$name 	  = $arrParam['name'];
		$email 	  = $arrParam['email'];
		$image	  = $arrParam['image'];
		$phone 	  = $arrParam['phone'];

		$query[] = "INSERT INTO `user` (`username`, `password`, `email`, `name`, `hinhanh`, `phone`, `idloaiuser`)";
		$query[] = "VALUES ('".$username."', '".$password."', '".$email."', '".$name."', '".$image."', '".$phone."', 2)";

		$query = implode(" ", $query);
		$result = $this->query($query);

		return $result;
	}

	public function songCabinet($id){
		$query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `baihat`.`hinhanh`, `casy`.`idcasy`, `casy`.`tencasy`";
		$query[] = "FROM `baihat`, `casy`, `khonhac`";
		$query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
		$query[] = "AND `khonhac`.`idbaihat` = `baihat`.`idbaihat`";
		$query[] = "AND `khonhac`.`iduser` = " . $id;

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}

	public function mvCabinet($id){
		$query[] = "SELECT `mv`.`idmv`, `mv`.`hinhanh`, `baihat`.`tenbh`, `casy`.`idcasy`, `casy`.`tencasy`";
		$query[] = "FROM `mv`, `baihat`, `casy`, `khomv`";
		$query[] = "WHERE `mv`.`idbaihat` = `baihat`.`idbaihat`";
		$query[] = "AND `baihat`.`idcasy` = `casy`.`idcasy`";
		$query[] = "AND `mv`.`idmv` = `khomv`.`idmv`";
		$query[] = "AND `khomv`.`iduser` = " . $id;

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}

	public function suggests(){
		$query[] = "SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`, `casy`.`idcasy`, `casy`.`tencasy`, `casy`.`hinhanh` as `img-casy`";
		$query[] = "FROM `baihat`, `casy`";
		$query[] = "WHERE `baihat`.`idcasy` = `casy`.`idcasy`";
		$query[] = "ORDER BY RAND() LIMIT 10";

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}

}