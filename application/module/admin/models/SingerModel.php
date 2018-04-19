<?php
class SingerModel extends Model{
    private $_columns = array('idcasy', 'tencasy', 'hinhanh', 'infocasy', 'luotquantam', 'idquocgia');
	public function __construct(){
		parent::__construct();
		$this->table = 'casy';
	}

    
    public function listSinger($arrParam, $option = null){
        $query[] = 'SELECT `tencasy`, `hinhanh`, `infocasy`, `luotquantam`, `idcasy`';
        $query[] = 'FROM `'.$this->table.'`';
        //$query[] = 'WHERE `idcasy` > 1 ';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "AND `tencasy` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        //Sort
        if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_direction'])){
            $column = $arrParam['filter_column'];
            $direction = $arrParam['filter_direction'];
            $query[] = "ORDER BY `$column` $direction ";
        }else{
            $query[] = "ORDER BY `idcasy` ASC ";
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

    public function countSinger($arrParam, $option = null){
        $query[] = 'SELECT COUNT(`idcasy`) AS `total`';
        $query[] = 'FROM `'.$this->table.'`';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "WHERE `tencasy` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result['total'];
    }

    //ADD ITEMS
    public function saveItem($arrParam, $option = null){

        
        $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));

        if($option['task'] == 'add'){
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $this->lastID();
        } 
        if($option['task'] == 'edit'){
            $tencasy = $arrParam['form']['tencasy'];
            $hinhanh = $arrParam['form']['hinhanh'];
            $idquocgia = $arrParam['form']['idquocgia'];
            $info = $arrParam['form']['infocasy'];

            $query[] = "UPDATE `casy`";
            $query[] = "SET `tencasy` = '".$tencasy."', `hinhanh` = '".$hinhanh."', `infocasy` = '".$info."', `idquocgia` = ".$idquocgia;
            $query[] = "WHERE `idcasy` = " . $arrParam['form']['idcasy'];
            $query =  implode(" ", $query);

            $this->query($query);

            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $data['idcasy'];
        }
    }

    //SHOW INFO ITEMS
    public function showInfoItems($id, $option = null){
        //`idbaihat`, `tenbh`, `hinhanh`, `ngayphathanh`, `idquocgia`,`dexuat`,`idnghesy`,`idcasy`,`idtheloai`,`idalbum` 
        if($option == null){


            $query[] = "SELECT `idcasy`, `tencasy`, `infocasy`";
            $query[] = "FROM `".$this->table."`";
            $query[] = "WHERE `idcasy` = " . $id;


            $query = implode(" ", $query);
            $result = $this->singleRecord($query);
            return $result;
        } 
    }

    //DELETE ITEMS
    public function deleteItems($arrParam, $option = null){
        if($option == null){
            $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
            if(!empty($arrParam['cid'])){
                $query  = "DELETE FROM `$this->table` WHERE `idcasy` IN ($arrID)";
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
}
?>