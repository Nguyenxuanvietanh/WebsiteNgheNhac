<?php
class UserModel extends Model{
	public function __construct(){
		parent::__construct();
		$this->table = 'user';
	}

	public function userList($arrParam, $option = null){
		$query[] = "SELECT `user`.`name`, `user`.`iduser`, `user`.`username`, `user`.`hinhanh`, `user`.`email`, `user`.`phone`, `loaiuser`.`loaiuser`";
		$query[] = "FROM `user`, `loaiuser`";
		$query[] = "WHERE `user`.`idloaiuser` = `loaiuser`.`idloaiuser`";

		$flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "AND `user`.`name` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

		$query = implode(" ", $query);
		$result = $this->listRecord($query);
		return $result;
	}

	public function countUser($arrParam, $option = null){
        $query[] = 'SELECT COUNT(`iduser`) AS `total`';
        $query[] = 'FROM `'.$this->table.'`';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "WHERE `name` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }


        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result['total'];
    }

    //UPGRADE
    public function upgrade($arrParam, $option = null){
        if($option == null){
            $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
            if(!empty($arrParam['cid'])){
                $query  = "UPDATE `$this->table` SET `idloaiuser` = `idloaiuser` - 1 WHERE `iduser` IN ($arrID) AND `idloaiuser` = 3";
                $this->query($query);
                if($this->affectedRows() > 0){
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' User đã được thăng chức thành Admin !'));
                }else{
                    Session::set('message', array('class' => 'error', 'content' =>' Không thể thăng chức nữa !'));
                }
                
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn user muốn thăng chức !'));
            }
        }
    }

    //UPGRADE
    public function downgrade($arrParam, $option = null){
        if($option == null){
            $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
            if(!empty($arrParam['cid'])){
                $query  = "UPDATE `$this->table` SET `idloaiuser` = `idloaiuser` + 1 WHERE `iduser` IN ($arrID)  AND `idloaiuser` = 2";
                $this->query($query);
                if($this->affectedRows() > 0){
                    Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' Admin đã bị giáng chức thành User !'));
                }else{
                    Session::set('message', array('class' => 'error', 'content' => ' Không thể giáng chức !'));
                }
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn admin muốn giáng chức !'));
            }
        }
    }

    //DELETE ITEMS
    public function deleteItems($arrParam, $option = null){
        if($option == null){
            $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
            if(!empty($arrParam['cid'])){
                $query  = "DELETE FROM `$this->table` WHERE `iduser` IN ($arrID)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' user đã bị xóa !'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn phần tử muốn xóa !'));
            }
            
        } 
    }
}
?>