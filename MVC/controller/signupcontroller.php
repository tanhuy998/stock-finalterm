<?php  
    class SignUpController {

        public function Index($_request) {

            if (count($_request['data']) == 0) {
                var_dump($_request['data']);
                //Account::New();

                echo 1;
                $view = new SignUpView();
            }
            else {
                $data = $_request['data'];

                if (Account::New($data)) {

                    Route::Redirect('home/');
                }
            }
        }

        public function Sign() {

        }
    }