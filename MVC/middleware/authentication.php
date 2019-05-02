<?php
    class Authentication extends Middleware {

        public function __construct() {
            $this->passStatus = false;
        }

        public function Invoke($args = null) {
            $acc = new Account('name','1234');


            if ($acc->IsValid()) {
                $this->passStatus = true;
                //echo 'pass';
            }
            else {
                echo 'wrong user';
            }
        }
    }