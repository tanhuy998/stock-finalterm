<?php
    class Authentication extends Middleware {

        public function __construct() {
            $this->passStatus = false;
        }

        public function Invoke($args = null) {
            $username;
            $password;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];
            }

            $acc = new Account($username,$password);


            if ($acc->IsValid()) {
                $this->passStatus = true;
                //echo 'pass';
            }
            else {
                echo 'wrong user';
            }
        }
    }