<?php
    class Authenticator extends Middleware {

        public function __construct() {
            $this->passStatus = false;
        }

        public function Invoke($args = null) {
            if (isset($_COOKIE['token'])) {
                echo 1;


            }
            else {
                echo 2;
            }
        }
    }