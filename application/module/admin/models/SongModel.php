<?php
class SongModel extends Model{

    private $_columns = array('idbaihat','tenbh','hinhanh','ngayphathanh','idquocgia','dexuat','idnghesy','idcasy','idtheloai','idalbum', 'idchude');

	public function __construct(){
        parent::__construct();
        $this->setTable(TB_SONG);
    }

    public function showDataField($table, $field, $idtable, $id){

        $query = 'SELECT `'.$field.'` FROM `'.$table.'` WHERE `'.$idtable.'` = ' . $id;
        $data = $this->singleRecord($query);
        foreach($data as $dataField){
            return $dataField;
        }

    }
    
    public function listSong($arrParam, $option = null){
        $query[] = 'SELECT `baihat`.`idbaihat`, `baihat`.`tenbh`,`baihat`.`dexuat`, `baihat`.`hinhanh`, `baihat`.`ngayphathanh`, `casy`.`tencasy`, `album`.`tenalbum`';
        $query[] = 'FROM `'.$this->table.'`, `casy`, `album`';
        $query[] = 'WHERE `baihat`.`idcasy` = `casy`.`idcasy` AND `baihat`.`idalbum` = `album`.`idalbum` ';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "AND `tenbh` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        //Filter Status
        if(isset($arrParam['filterStatus']) && $arrParam['filterStatus'] != 'default'){
            //$status = ($arrParam['filterStatus'] == 'unpublic') ? 0 : 1;
            if($flagWhere == true){
                $query[] = "AND `".$this->table."`.`dexuat` = '".$arrParam['filterStatus']."'";
            }else{
                $query[] = "AND `".$this->table."`.`dexuat` = '".$arrParam['filterStatus']."'";
            }
        }

        //Sort
        if(!empty($arrParam['filter_column']) && !empty($arrParam['filter_direction'])){
            $column = $arrParam['filter_column'];
            $direction = $arrParam['filter_direction'];
            $query[] = "ORDER BY `$column` $direction ";
        }else{
            $query[] = "ORDER BY `idbaihat` ASC ";
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

    public function countSong($arrParam, $option = null){
        $query[] = 'SELECT COUNT(`idbaihat`) AS `total`';
        $query[] = 'FROM `'.$this->table.'`';

        $flagWhere = false;
        //Filter Search
        if(!empty($arrParam['search'])){
            $query[] = "WHERE `tenbh` LIKE '%".$arrParam['search']."%'";
            $flagWhere = true;
        }

        //Filter Status
        if(isset($arrParam['filterStatus']) && $arrParam['filterStatus'] != 'default'){
            if($flagWhere == true){
                $query[] = "AND `dexuat` = '".$arrParam['filterStatus']."'";
            }else{
                $query[] = "WHERE `dexuat` = '".$arrParam['filterStatus']."'";
            }
            
        }

        $query = implode(" ", $query);
        $result = $this->singleRecord($query);
        return $result['total'];
    }


    //CHANGE STATUS
    public function changeStatus($arrParam, $option = null){
        if($option['task'] == 'change-ajax-status'){
            $status = ($arrParam['status'] == 0) ? 1 : 0;
            $id = $arrParam['id'];
            $query = "UPDATE `$this->table` SET `dexuat` = $status WHERE `idbaihat` = '" . $id . "'";
            $this->query($query);

            $result = array(
                        'id'        => $id, 
                        'status'    => $status, 
                        'link'      => URL::createLink('admin', 'song', 'ajaxStatus', array('id'=> $id,'status'=> $status))
                    );
            return $result;
        } 

        if($option['task'] == 'change-status'){
            $status = $arrParam['type'];
            $id = $arrParam['id'];
            
            if(!empty($arrParam['cid'])){
                $arrID = $this->createWhereDeleteSQL($arrParam['cid']);
                $query = "UPDATE `$this->table` SET `dexuat` = $status WHERE `idbaihat`IN ($arrID)";
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
                $query  = "DELETE FROM `$this->table` WHERE `idbaihat` IN ($arrID)";
                $query2 = "DELETE FROM `chitietbaihat` WHERE `idbaihat` IN ($arrID)";
                $this->query($query);
                $this->query($query2);
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

    //ADD, EDIT ITEMS
    public function saveItem($arrParam, $option = null){
        $arrParam['form']['dexuat'] = (isset($arrParam['form']['dexuat'])) ? $arrParam['form']['dexuat'] : 0;
        $arrParam['form']['idalbum'] = (isset($arrParam['form']['idalbum'])) ? $arrParam['form']['idalbum'] : 0;

        $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
        
        $ct   = array_diff_key($arrParam['form'], $data);

        if($option['task'] == 'add'){
            $this->insert($data);

            $idct = $this->lastID();

            $ctquery = "INSERT INTO `chitietbaihat`(`idbaihat`, `hinhanhct`,`infobaihat`,`mp3`,`lyrics`) 
                        VALUES('".$idct."', '".$ct['hinhanhct']."','".$ct['infobaihat']."', '".$ct['mp3']."', '".$ct['lyrics']."') ";
            $this->query($ctquery);
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $this->lastID();
        } 
        if($option['task'] == 'edit'){
            $tenbh = $arrParam['form']['tenbh'];
            $hinhanh = $arrParam['form']['hinhanh'];
            $ngayph = $arrParam['form']['ngayphathanh'];
            $idtl = $arrParam['form']['idtheloai'];
            $idal = $arrParam['form']['idalbum'];
            $idns = $arrParam['form']['idnghesy'];
            $idcs = $arrParam['form']['idcasy'];
            $idqg = $arrParam['form']['idquocgia'];
            $idcd = $arrParam['form']['idchude'];
            $dexuat = $arrParam['form']['dexuat'];
            //$this->update($data, array(array('idbaihat', $data['idbaihat'])));
            $query[] = "UPDATE `baihat`";
            $query[] = "SET `tenbh` = '".$tenbh."', `hinhanh` = '".$hinhanh."', `ngayphathanh` = '".$ngayph."', `idtheloai` = '".$idtl."', `idnghesy` = '".$idns."', `idcasy` = '".$idcs."', `idquocgia` = '".$idqg."', `idchude` = '".$idcd."', `dexuat` = '".$dexuat."' ";
            $query[] = "WHERE `idbaihat` = " . $arrParam['form']['idbaihat'];
            echo $query =  implode(" ", $query);

            //$this->query($query);

            $ctquery[] = "UPDATE `chitietbaihat`";
            $ctquery[] = "SET `hinhanhct` = '" . $ct['hinhanhct'] . "', `infobaihat` = '" . $ct['infobaihat'] . "', `mp3` = '" . $ct['mp3'] . "', `lyrics` = '" . $ct['lyrics'] . "'";
            $ctquery[] = "WHERE `idchitietbaihat` = " . $data['idbaihat'];

            echo $ctquery =  implode(" ", $ctquery);

            //$this->query($ctquery);
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $data['idbaihat'];
        }
    }

    //SHOW INFO ITEMS
    public function showInfoItems($idbh, $option = null){
 
        if($option == null){
            $qrbh = '`baihat`.`idbaihat`,`baihat`.`tenbh`, `baihat`.`hinhanh`, `baihat`.`ngayphathanh`';
            $qrct = '`chitietbaihat`.`infobaihat`, `chitietbaihat`.`mp3`, `chitietbaihat`.`luotnghe`, `chitietbaihat`.`luotthich`,`chitietbaihat`.`luottai`, `chitietbaihat`.`lyrics`';
            $ns   = '`nghesy`.`idnghesy`, `nghesy`.`tennghesy`';
            $al   = '`album`.`idalbum`, `album`.`tenalbum`';
            $cs   = '`casy`.`idcasy`,`casy`.`tencasy`';
            $qg   = '`quocgia`.`tenquocgia`, `quocgia`.`idquocgia`';
            $tl   = '`theloai`.`idtheloai`,`theloai`.`tentheloai`';
            $cd   = '`chude`.`idchude`,`chude`.`tenchude`';

            $query[] = 'SELECT '.$qrbh.', '.$qrct.', '.$ns.', '.$al.', '.$cs.', '.$qg.', '.$cd.', '.$tl.'';
            $query[] = 'FROM `'.$this->table.'`, `chitietbaihat`, `album` , `theloai`, `quocgia`, `casy`, `nghesy`, `chude` ';
            $query[] = 'WHERE `'.$this->table.'`.`idbaihat` = `chitietbaihat`.`idbaihat`';
            $query[] = 'AND `'.$this->table.'`.`idnghesy` = `nghesy`.`idnghesy`';
            $query[] = 'AND `'.$this->table.'`.`idalbum` = `album`.`idalbum`';
            $query[] = 'AND `'.$this->table.'`.`idcasy` = `casy`.`idcasy`';
            $query[] = 'AND `'.$this->table.'`.`idquocgia` = `quocgia`.`idquocgia`';
            $query[] = 'AND `'.$this->table.'`.`idtheloai` = `theloai`.`idtheloai`';
            $query[] = 'AND `'.$this->table.'`.`idchude` = `chude`.`idchude`';
            $query[] = 'AND `'.$this->table.'`.`idbaihat` = ' . $idbh;

            $query = implode(" ", $query);
            $result = $this->singleRecord($query);
            return $result;
        } 
    }

}

?>