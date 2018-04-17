<?php
    class URL{
        public static function createLink($module, $controller, $action, $arrParams = null){
            $linkParam = "";
            if(!empty($arrParams)){
                foreach($arrParams as $key => $value){
                    $linkParam .= "&$key=$value";
                }
            }
            $url = 'index.php?module='.$module.'&controller='.$controller.'&action='. $action . $linkParam ; 

            return $url;
        }

        public static function redirect($link){
            header('location: ' . $link);
            exit();
        }
    }
?>