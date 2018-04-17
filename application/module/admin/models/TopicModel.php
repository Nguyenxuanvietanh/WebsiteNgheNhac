<?php
class TopicModel extends Model{
    private $_columns = array('idchude','tenchude', 'hinhanh');
	public function __construct(){
        parent::__construct();
        $this->table = 'chude';
    }
    
    public function Topics($id = null){
        if($id != null){
            $query = "SELECT * FROM `chude` WHERE `idchude` = " .$id;
            $result = $this->singleRecord($query);
        }
        else{
            $query = "SELECT * FROM `chude`";
            $result = $this->listRecord($query);
        }
        return $result;
    }


    //ADD, EDIT ITEMS
    public function saveItem($arrParam, $option = null){
   
        $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));

        if($option['task'] == 'add'){
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
        } 
        if($option['task'] == 'edit'){
            $query[] = "UPDATE `chude`"; 
            $query[] = "SET `tenchude` = '" . $arrParam['form']['tenchude'] . "', `hinhanh` = '" . $arrParam['form']['hinhanh'] . "'";
            $query[] = "WHERE `idchude` = " . $arrParam['form']['idchude'];

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
                $query  = "DELETE FROM `$this->table` WHERE `idchude` IN ($arrID)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' phần tử đã được xóa !'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn phần tử muốn xóa !'));
            }
            
        } 
    }
}
?>