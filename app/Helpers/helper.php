<?php 


if(!function_exists('option')){
    function option($cat,$id){
        if($cat == $id){
            return "selected";
        }
        return '';
    }
}