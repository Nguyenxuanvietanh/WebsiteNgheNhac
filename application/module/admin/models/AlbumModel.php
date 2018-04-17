<?php
class AlbumModel extends Model{
    private $_columns = array('idalbum','tenalbum', 'infoalbum','hinhanh','idquocgia','dexuat','idcasy','idtheloai', 'idchude');
	public function __construct(){
		parent::__construct();
		$this->table = 'album';
	}

	public function listAlbum($arrParam, $option = null){
		$query[] = 'SELECT `album`.`tenalbum`, `album`.`hinhanh`, `album`.`infoalbum`, `album`.`idalbum`,`album`.`dexuat`,`album`.`luotnghe`,`album`.`luotthich`, ';
		$query[] = '`casy`.`tencasy`, `theloai`.`tentheloai`, `chude`.`tenchude`, `quocgia`.`tenquocgia`';
        $query[] = 'FROM `'.$this->table.'`, `casy`, `theloai`, `chude`, `quocgia`';
		$query[] = 'WHERE `album`.`idcasy` = `casy`.`idcasy` ';
		$query[] = 'AND `album`.`idtheloai` = `theloai`.`idtheloai` ';
		$query[] = 'AND `album`.`idchude` = `chude`.`idchude` ';
		$query[] = 'AND `album`.`idquocgia` = `quocgia`.`idquocgia` ';
		$query[] = 'AND `album`.`idalbum` > 1';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "AND `tenalbum` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        //Sort
        if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_direction'])){
            $column = $arrParam['filter_column'];
            $direction = $arrParam['filter_direction'];
            $query[] = "ORDER BY `$column` $direction ";
        }else{
            $query[] = "ORDER BY `idalbum` ASC ";
        }

        //PAGINATION
        $pagination = $arrParam['pagination'];
        
        $totalItemsPerPage = $pagination['totalItemsPerPage'];
        if($totalItemsPerPage > 0){
            $position = ($pagination['currentPage'] - 1) * $totalItemsPerPage;
            $query[] = "LIMIT $position, $totalItemsPerPage";
        }
        
        
        $query = implode(" ", $query);
        $result = $this->listRecord($query);
        return $result;
    }

    public function countAlbum($arrParam, $option = null){
        $query[] = 'SELECT COUNT(`idalbum`) AS `total`';
        $query[] = 'FROM `'.$this->table.'`';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "WHERE `tenalbum` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result['total'];
    }

    //ADD, EDIT ITEMS
    public function saveItem($arrParam, $option = null){
   
        $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));

        if($option['task'] == 'add'){
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
        } 
        if($option['task'] == 'edit'){
            $tenalbum = $arrParam['form']['tenalbum'];
            $hinhanh = $arrParam['form']['hinhanh'];
            $info = $arrParam['form']['infoalbum'];
            $dexuat = $arrParam['form']['dexuat'];
            $idcasy = $arrParam['form']['idcasy'];
            $idtheloai = $arrParam['form']['idtheloai'];
            $idquocgia = $arrParam['form']['idquocgia'];
            $idchude = $arrParam['form']['idchude'];

            $query[] = "UPDATE `album`";
            $query[] = "SET `tenalbum` = '".$tenalbum."', `hinhanh` = '".$hinhanh."', `infoalbum` = '".$info."', `dexuat` = ".$dexuat.",";
            $query[] = "`idcasy` = " . $idcasy . ", `idtheloai` = " . $idtheloai . ", `idquocgia` = " . $idquocgia . ", `idchude` = " . $idchude;
            $query[] = "WHERE `idalbum` = " . $arrParam['form']['idalbum'];
            $query =  implode(" ", $query);

            $this->query($query);

            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
        }
    }

    //CHANGE STATUS
    public function changeStatus($arrParam, $option = null){
        if($option['task'] == 'change-ajax-status'){
            $status = ($arrParam['status'] == 0) ? 1 : 0;
            $id = $arrParam['id'];
            $query = "UPDATE `$this->table` SET `dexuat` = $status WHERE `idalbum` = '" . $id . "'";
            $this->query($query);

            $result = array(
                        'id'        => $id, 
                        'status'    => $status, 
                        'link'      => URL::createLink('admin', 'album', 'ajaxStatus', array('id'=> $id,'status'=> $status))
                    );
            return $result;
        } 

        if($option['task'] == 'change-status'){
            $status = $arrParam['type'];
            $id = $arrParam['id'];
            
            if(!empty($arrParam['cid'])){
                $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
                $query = "UPDATE `$this->table` SET `dexuat` = $status WHERE `idalbum`IN ($arrID)";
                $this->query($query);

                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' phần tử đã thay đổi trạng thái !'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn phần tử muốn thay đổi trạng thái !'));
            }

        }
    }

    //DELETE ITEMS
    public function deleteItems($arrParam, $option = null){
        if($option == null){
            $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
            if(!empty($arrParam['cid'])){
                $query  = "DELETE FROM `$this->table` WHERE `idalbum` IN ($arrID)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' phần tử đã được xóa !'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn phần tử muốn xóa !'));
            }
            
        } 
    }

    //FORM SELECT BOX 
    public function dataRow($table, $key, $value, $condition = null){
        $query[] = "SELECT `$key`, `$value`";
        $query[] = "FROM `$table`";
        if($condition != null){
            $query[] = "WHERE" . $condition;
        }
        $query = implode(" ", $query);
        $result = $this->listRecord($query);

        return $result;
    }

    //SHOW INFO ITEMS
    public function showInfoItems($id, $option = null){
        //`idbaihat`, `tenbh`, `hinhanh`, `ngayphathanh`, `idquocgia`,`dexuat`,`idnghesy`,`idcasy`,`idtheloai`,`idalbum` 
        if($option == null){
            $query[] = "SELECT `album`.`idalbum`, `album`.`tenalbum`, `album`.`hinhanh`, `album`.`infoalbum`,`album`.`dexuat`,";
            $query[] = "`casy`.`idcasy`, `casy`.`tencasy`, `theloai`.`idtheloai`,`theloai`.`tentheloai`, `quocgia`.`idquocgia`,`quocgia`.`tenquocgia`, `chude`.`idchude`, `chude`.`tenchude`";
            $query[] = "FROM `album`, `casy`, `theloai`, `quocgia`, `chude`";
            $query[] = "WHERE `album`.`idcasy` = `casy`.`idcasy`";
            $query[] = "AND `album`.`idtheloai` = `theloai`.`idtheloai`";
            $query[] = "AND `album`.`idquocgia` = `quocgia`.`idquocgia`";
            $query[] = "AND `album`.`idchude` = `chude`.`idchude`";
            $query[] = "AND `album`.`idalbum` = " . $id;

            $query = implode(" ", $query);
            $result = $this->singleRecord($query);
            return $result;
        } 
    }

}
?>