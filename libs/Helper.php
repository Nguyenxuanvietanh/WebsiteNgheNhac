<?php
class Helper{
    //CREATE BUTTON
    public static function cmsButton($link, $icon, $type = 'new'){
        if($type == 'new'){
            $xhtml = '<a href="'.$link.'"><div class="icon '.$icon.'"></div></a>';
        }else if($type == 'submit'){
            $xhtml = '<a href="#" onclick="javascript:submitForm(\''.$link.'\');"><div class="icon '.$icon.'"></div></a>';
        }
        
        return $xhtml;
    }

    //CREATE STATUS
    public static function cmsStatus($statusValue, $link, $id){
        $statusStr = ($statusValue == 0) ? 'uncheck' : 'check';
        $xhtml = '<a id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\')">
                    <span class="'.$statusStr.'"></span>
                  </a>';
        return $xhtml;
    }

    //CREATE LINK SORT
    public static function cmsLinkSort($name, $column, $columnPost, $orderPost){
        $img = '';
        $order = ($orderPost == 'desc') ? 'asc' : 'desc';
        
        if($column == $columnPost){
            $img = '<img height="10" src="'.TEMPLATE_URL.'admin/main/images/'.$orderPost.'.png" alt="">';
        }
        $xhtml = '<a href="#" onClick="javascript:sortList(\''.$column.'\', \''.$order.'\')">'.$name.'   '.$img.'</a>';
        return $xhtml;

    }

    //CREATE SELECT BOX
    public static function cmsSelectBox($name, $arrValue, $keySelect = 'default'){

        $xhtml = ' <select name="'.$name.'" id="">';
        foreach($arrValue as $key => $value){
            if($key == $keySelect && is_numeric($keySelect)){
                $xhtml .= '<option selected="selected" value="'.$key.'">'.$value.'</option>';
            }else{
                $xhtml .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }
                        
        $xhtml .= '</select>';
        return $xhtml;
    }


    //CREATE INPUT
    public static function cmsInput($type, $name, $id, $value, $class = null){
        $xhtml = '<input type="'.$type.'" name="'.$name.'" id="'.$id.'" value="'.$value.'" class="'.$class.'">';
        
        return $xhtml;
    }

    //CREATE TEXT-AREA
    public static function cmsTextArea($name, $id, $row, $class, $value){
        $xhtml = '<textarea name="'.$name.'" id="'.$id.'" rows="'.$row.'" class="'.$class.'">'.$value.'</textarea>';
        
        return $xhtml;
    }

    //CREATE CKEDITOR
    public static function cmsEditor($name, $id, $value){
        $xhtml = '<textarea name="'.$name.'" id="'.$id.'" class="ckeditor">'.$value.'</textarea>';
        
        return $xhtml;
    }

    //CREATE CHECKBOX
    public static function cmsCheckbox($name, $arrValue, $check = false){
        foreach($arrValue as $key => $value){
            if($check == true){
                $xhtml = '<input name="'.$name.'" checked="checked" type="checkbox" class="form-check-input" id="'.$key.'" value="'.$key.'">
                            <label class="form-check-label cbl" for="'.$key.'">'.$value.'</label>';
            }else{
                $xhtml = '<input name="'.$name.'" type="checkbox" class="form-check-input" id="'.$key.'" value="'.$key.'">
                            <label class="form-check-label cbl" for="'.$key.'">'.$value.'</label>';
            }
        }
        
        return $xhtml;
    }

    //CREATE CHECKBOX LIST
    public static function cmsCheckboxList($name , $arrValue){
        foreach($arrValue as $key => $value){
            $xhtml .= '<input name="'.$name.'[]" type="checkbox" class="form-check-input" id="'.$key.'" value="'.$key.'">
                    <label class="form-check-label cbl" for="'.$key.'">'.$value.'</label>';
        }
        
        return $xhtml;
    }

    //CREATE FORM ROW
    public static function cmsFormRow($lblName, $input, $required = false, $class = null){
        $strRequired = '';
        if($required == true) $strRequired = '<span style="color: red; font-style: italic;">(*)</span>';
        $xhtml = '<div class="form-group '.$class.'">
                    <label >'.$lblName.': </label>'.$strRequired.'<br />'.$input.'
                </div>';
        
        return $xhtml;
    }

    //CREATE MESSAGE
    public static function cmsMessage($message){
        $xhtml = '';
        if(!empty($message)){
            $xhtml = '<div class="message">
                        <div class="'.$message['class'].'">
                            <span>'.$message['content'].'</span>
                        </div>
                    </div>';
        }
        return $xhtml;
    }
    
    //FORMAT DATE
    public static function formatDate($format, $value){
        $result = '';
        if(!empty($value) && $value != '0000-00-00'){
            $result = date($format, strtotime($value));
        }
        return $result;
    }

    //CONVERT LANGUAGE
    function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        //$str = str_replace(” “, “-”, str_replace(“&*#39;”,”",$str));
        $str = str_replace(" ", "-", $str);
        return $str;
    }

    //CREATE LIKE
    // public static function cmsLike($likeValue, $link, $id){
    //     $likeStr = ($likeValue == 0) ? 'zicon' : 'liked';
    //     $xhtml = '<a href="javascript:changeLike(\''.$link.'\')" class="zlike" id="btnLike">
    //                     <span class="'.$likeStr.'" id="iconLike"></span>Thích
    //                 </a>';
    //     return $xhtml;
    // }
}
?>