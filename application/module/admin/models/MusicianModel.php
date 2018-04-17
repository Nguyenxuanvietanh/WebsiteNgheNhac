<?php
class MusicianModel extends Model{
    private $_columns = array('idnghesy', 'tennghesy', 'hinhanh', 'infonghesy', 'luotquantam');
	public function __construct(){
		parent::__construct();
		$this->table = 'nghesy';
	}

    
    public function listMusician($arrParam, $option = null){
        $query[] = 'SELECT `tennghesy`, `hinhanh`, `infonghesy`, `luotquantam`, `idnghesy`';
        $query[] = 'FROM `'.$this->table.'`';
        $query[] = 'WHERE `idnghesy` > 1 ';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "AND `tennghesy` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        //Sort
        if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_direction'])){
            $column = $arrParam['filter_column'];
            $direction = $arrParam['filter_direction'];
            $query[] = "ORDER BY `$column` $direction ";
        }else{
            $query[] = "ORDER BY `idnghesy` ASC ";
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

    public function countMusician($arrParam, $option = null){
        $query[] = 'SELECT COUNT(`idnghesy`) AS `total`';
        $query[] = 'FROM `'.$this->table.'`';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "WHERE `tennghesy` LIKE '%".$arrParam['search']."%'";
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
            $tennghesy = $arrParam['form']['tennghesy'];
            $hinhanh = $arrParam['form']['hinhanh'];
            $info = $arrParam['form']['infonghesy'];

            $query[] = "UPDATE `nghesy`";
            $query[] = "SET `tennghesy` = '".$tennghesy."', `hinhanh` = '".$hinhanh."', `infonghesy` = '".$info."'";
            $query[] = "WHERE `idnghesy` = " . $arrParam['form']['idnghesy'];
            $query =  implode(" ", $query);

            $this->query($query);

            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $data['idbaihat'];
        }
    }

    //SHOW INFO ITEMS
    public function showInfoItems($id, $option = null){
        if($option == null){


            $query[] = "SELECT `idnghesy`, `tennghesy`, `infonghesy`";
            $query[] = "FROM `".$this->table."`";
            $query[] = "WHERE `idnghesy` = " . $id;


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
                $query  = "DELETE FROM `$this->table` WHERE `idnghesy` IN ($arrID)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' phần tử đã được xóa !'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn phần tử muốn xóa !'));
            }
            
        } 
    }
}
?>