<?php
    class Session{
        /**
         * 
         * Function exists
         * Parameter string
         * Return boolean
         */
        public static function exists($name){
            return (isset($_SESSION[$name])) ? true : false;
        }
        /**
         * 
         * Function put
         * Parameter string
         * Return session
         */
        public static function put($name, $value){
            return $_SESSION[$name] = $value;
        }
        /**
         * 
         * Function get
         * Parameter string
         * rerurn session
         */
        public static function get($name){
            return $_SESSION[$name];
        }
        /**
         * 
         * Function delete
         * parameter string
         * Return this
         */
        public static function delete($name){
            if(self::exists($name)){
                unset($_SESSION[$name]);
            }
        }
        
        public static function flash($name, $string = ''){
            if(self::exists($name)){
                $session = self::get($name);
                self::delete($name);
                return $session;
            }else{
                self::put($name, $string);
            }
        }
    }