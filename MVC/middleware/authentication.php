<?php
    class Authentication extends Middleware {

        public function __construct() {
            $this->meta = [
                'status' => false
            ];

            $this->passStatus = false;
        }

        public function Invoke($args = null) {
            $username;
            $password;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $acc = new Account($username,$password);

                if ($acc->IsValid()) {
                    $this->passStatus = true;
                    //echo 'pass';
                    $data = [];

                    $this->PlaceToken($data);

                    $this->passStatus = true;
                    $this->meta['status'] = $this->passStatus;
                    return $this->meta;
                }
                else {
                    echo 'wrong user';
                    $this->meta['status'] = $this->passStatus;
                    $this->meta['redirect'] = 'login?error=1';

                    return $this->meta;
                }
            }
            else {
                $token_data = $this->TokenAuthenticate();

                if (!isset($token_data)) {

                    $this->meta['status'] = $this->passStatus;
                    $this->meta['redirect'] = 'login/';

                    return null;
                }
                else {

                }
            }
        } 

        public function TokenAuthenticate() {
            $token = $this->GetToken();

            if (isset($token)) {
                $data = $this->ParseToken($token);
                
                return $data;
            }
            return null;
        }

        private function GetToken() {
            $token = $_COOKIE['token'];

            if (isset($token)) {

                return $token;
            }

            return null;
        }

        private function PlaceToken(array $_data) {

        }

        private function ParseToken($_token): array {
            $return_data = [];

            return $return_data;
        }


    }