<?php
    class Validate{
        
        private $_passed = false,
                $_errors = array(),
                $_db     = null;
                
        public function __construct(){
            $this->_db = DB::getInstance();
        }
        
        /**
         * Function check
         * Parameters $source = $_POST
         * Return
         */
         
         public function check($source, $items = array()){
            foreach($items as $item => $rules){
                foreach($rules as $rule => $rule_value){
                    $value = $source[$item];
                    if($rule === 'required' && empty($value)){
                        $this->addError("{$item} is required.");
                    }else if(!empty($value)){
                        switch($rule){
                            case 'min':
                                if(strlen($value) < $rule_value){
                                    $this->addError("{$item} co so ki tu nho nhat {$rule_value}");
                                }
                            break;           
                            case 'max':
                                if(strlen($value) > $rule_value){
                                    $this->addError("{$item} co so ki tu lon nhat là {$rule_value}");
                                }
                            break;
                            case 'matches':
                                if($value!=$source[$rule_value]){
                                    $this->addError("{$rule_value} khong giong {$item}");
                                }
                            break;
                            case 'unique':
                                $check = $this->_db->get($rule_value, array($item, '=', $value));
                                if($check->hasCount() > 0){
                                    $this->addError("{$item} da ton tai");
                                }
                            break;
                        }
                    }
                }
            }
            
            if(empty($this->_errors)){
                $this->_passed = true;
            }
            return $this;
         }
         
         /**
          * 
          * Function passed
          * Return boolean
          */
         public function passed(){
            return $this->_passed;
         }
         /**
          * 
          * Function addError
          * Parameter string
          * Return array
          */
          private function addError($error){
            $this->_errors[] = $error;
          }
         /**
          * Function error
          * Return array
          */
          public function errors(){
            return $this->_errors;
          }
    }