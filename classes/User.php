<?php 
    class User{
        private $_db,
                $_data,
                $_sessionName,
                $_isLoggedIn;
        
        public function __construct($user = null){
            $this->_db = DB::getInstance();
            $this->_sessionName = Config::get('session/session_name');
            
            // Check exists user
            if(!$user){
                // Check exists session user
                if(Session::exists($this->_sessionName)){
                    $user = Session::get($this->_sessionName);
                    if($this->find($user)){
                        $this->_isLoggedIn = true;
                    }
                }
            }else{
                $this->find($user);
            }
        }
        /**
         * 
         * Function login
         * Parameter username and password = string
         * Return boolean
         */
        public function login($username = null, $password = null){
            $user = $this->find($username);
            if($user){
                // Check password
                if (password_verify($password, $this->_data->password)) {
                    // Create user session_name
                    Session::put($this->_sessionName, $this->_data->id);
                    Session::flash('login_success', 'Bạn đăng nhập thành công.');
                    return true;
                }else{
                    Session::flash('login_false', 'Tài khoản hoặc mật khẩu không đúng!');
                    return false;
                }
            }
            return false;
        }
        
        public function find($user = null){
            if($user){
                $field = (is_numeric($user)) ? 'id' : 'username';
                $data = $this->_db->get('users', array($field, '=', $user));
                if($data->hasCount()){
                    $this->_data = $data->fisrt();
                    return true;
                }
            }
            return false;
        }
        
        public function getAll(){
            return $this->_db->query('SELECT * FROM users')->results();
        }
        
        public function create($fields = array()){
            if(!$this->_db->insert('users', $fields)){
                throw new Exception('Co van de xay ra khi tao tai khoan.');
            }
        }
        
        public function data(){
            return $this->_data;
        }
        
        public function isLoggedIn(){
            return $this->_isLoggedIn;
        }
         
        public function logout(){
            // Delete user session
            if($this->_sessionName){
                Session::delete($this->_sessionName);
                Redirect::to('login.php');
            }else{
                Redirect::to('login.php');
            }
        }
    }