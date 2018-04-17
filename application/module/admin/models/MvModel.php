<?php
class MvModel extends Model{
    //private $_columns = array('idcasy', 'tencasy', 'hinhanh', 'infocasy', 'luotquantam');
	public function __construct(){
		parent::__construct();
		$this->table = 'mv';
	}

    
    public function mvList($arrParam, $option = null){
        $query[] = 'SELECT `mv`.`idmv`, `mv`.`hinhanh`, `mv`.`linkvideo`, `mv`.`infomv`, `mv`.`luotthich`, `mv`.`luotxem`, `mv`.`luottai`, `mv`.`dexuat`,`baihat`.`tenbh`';
        $query[] = 'FROM `'.$this->table.'`, `baihat`';
        $query[] = 'WHERE `baihat`.`idbaihat` = `mv`.`idbaihat` ';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "AND `baihat`.`tenbh` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        //Sort
        if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_direction'])){
            $column = $arrParam['filter_column'];
            $direction = $arrParam['filter_direction'];
            $query[] = "ORDER BY `$column` $direction ";
        }else{
            $query[] = "ORDER BY `mv`.`idmv` ASC ";
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

    //CHANGE STATUS
    public function changeStatus($arrParam, $option = null){
        if($option['task'] == 'change-ajax-status'){
            $status = ($arrParam['status'] == 0) ? 1 : 0;
            $id = $arrParam['id'];
            $query = "UPDATE `$this->table` SET `dexuat` = $status WHERE `idmv` = '" . $id . "'";
            $this->query($query);

            $result = array(
                        'id'        => $id, 
                        'status'    => $status, 
                        'link'      => URL::createLink('admin', 'mv', 'ajaxStatus', array('id'=> $id,'status'=> $status))
                    );
            return $result;
        } 

        if($option['task'] == 'change-status'){
            $status = $arrParam['type'];
            $id = $arrParam['id'];
            
            if(!empty($arrParam['cid'])){
                $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
                $query = "UPDATE `$this->table` SET `dexuat` = $status WHERE `idmv`IN ($arrID)";
                $this->query($query);

                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' phần tử đã thay đổi trạng thái !'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn phần tử muốn thay đổi trạng thái !'));
            }

        }
    }

    public function countMv($arrParam, $option = null){
        $query[] = 'SELECT COUNT(`mv`.`idmv`) AS `total`, `baihat`.`tenbh`';
        $query[] = 'FROM `'.$this->table.'`, `baihat`';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "WHERE `baihat`.`tenbh` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);

        return $result['total'];
    }

    public function showSongName($id){
        $query = "SELECT `idbaihat`, `tenbh` FROM `baihat` WHERE `idbaihat` = " . $id;
        $result = $this->singleRecord($query);
        return $result;
    }

    //ADD ITEMS
    public function saveItem($arrParam, $option = null){
        $arrParam['form']['dexuat'] = (isset($arrParam['form']['dexuat'])) ? $arrParam['form']['dexuat'] : 0;
        if($option['task'] == 'add'){
            $idbh = $arrParam['form']['idbaihat'];
            $hinhanh = $arrParam['form']['hinhanh'];
            $linkvideo = $arrParam['form']['video'];
            $info = $arrParam['form']['infomv'];
            $dexuat     = $arrParam['form']['dexuat'];

            $query[] = "INSERT INTO `mv`(`idbaihat`, `hinhanh`, `linkvideo`, `infomv`, `dexuat`)";
            $query[] = "VALUES (".$idbh.", '".$hinhanh."', '".$linkvideo."', '".$info."', ".$dexuat.")";
            $query =  implode(" ", $query);
            $this->query($query);
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
        } 
        if($option['task'] == 'edit'){
            $video      = $arrParam['form']['video'];
            $hinhanh    = $arrParam['form']['hinhanh'];
            $info       = $arrParam['form']['infomv'];
            $dexuat     = $arrParam['form']['dexuat'];

            $query[] = "UPDATE `mv`";
            $query[] = "SET `linkvideo` = '".$video."', `hinhanh` = '".$hinhanh."', `infomv` = '".$info."', `dexuat` = " . $dexuat;
            $query[] = "WHERE `idmv` = " . $arrParam['form']['idmv'];
            $query =  implode(" ", $query);

            $this->query($query);

            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
        }
    }


    //DELETE ITEMS
    public function deleteItems($arrParam, $option = null){
        if($option == null){
            $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
            if(!empty($arrParam['cid'])){
                $query  = "DELETE FROM `$this->table` WHERE `idmv` IN ($arrID)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' phần tử đã được xóa !'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn phần tử muốn xóa !'));
            }
            
        } 
    }
}
?>