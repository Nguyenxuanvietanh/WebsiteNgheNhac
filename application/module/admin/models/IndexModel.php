<?php
class IndexModel extends Model{
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

}

?>