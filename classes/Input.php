<?php

    class Input{
        /**
         * Function Exists
         * Parameter string
         * return boolean
         */
        public static function exists($type = 'post'){
            switch($type){
                case 'post':
                    return (!empty($_POST)) ? true : false;
                break;
                case 'get':
                    return (!empty($_GET)) ? true : false;
                break;
                default:
                    return false;
                break;
            }
        }
        
        /**
         * 
         * Function get
         * Parameter string
         * Return string
         */
         public static function get($item){
            if(isset($_POST[$item])){
                return $_POST[$item];
            }else if(isset($_GET[$item])){
                return $_GET[$item];
            }
            return '';
         }
    }