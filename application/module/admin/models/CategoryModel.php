<?php
class CategoryModel extends Model{
    private $_columns = array('idtheloai','tentheloai', 'hinhanh');
	public function __construct(){
        parent::__construct();
        $this->table = 'theloai';
    }
    
    public function Categories($id = null){
        if($id != null){
            $query = "SELECT * FROM `theloai` WHERE `idtheloai` = " .$id;
            $result = $this->singleRecord($query);
        }
        else{
            $query = "SELECT * FROM `theloai`";
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
            $query[] = "UPDATE `theloai`"; 
            $query[] = "SET `tentheloai` = '" . $arrParam['form']['tentheloai'] . "', `hinhanh` = '" . $arrParam['form']['hinhanh'] . "'";
            $query[] = "WHERE `idtheloai` = " . $arrParam['form']['idtheloai'];

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
                $query  = "DELETE FROM `$this->table` WHERE `idtheloai` IN ($arrID)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => $this->affectedRows().' phần tử đã được xóa !'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn phần tử muốn xóa !'));
            }
            
        } 
    }
}
?>