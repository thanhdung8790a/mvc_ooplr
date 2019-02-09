<?php
    class passwordHash{
        public static function generate_bcrypt($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }
    }
    