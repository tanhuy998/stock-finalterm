<?php

    class HomeController {

        public function Index($_request) {
            //echo 'fuck yeah'.$_temp;

            //echo __DIR__;
            // $db = new Model('TRADER_STOCK','1234','orcl');

            // //$sql = 'INSERT INTO ACCOUNT (ID,ACCOUNT_NAME,PASSWORD) VALUES (2,\'trade2\',\'123\')';
            
            // //$db->Insert($sql);
            // $acc_model = new AccountModel();

            // $acc_model->InsertSingle('name', '1234');

            // $sql = 'SELECT * FROM ACCOUNT';

            // $res = $db->Select($sql);

            // var_dump($res);
            //echo $_SERVER['SERVER_ADDR'];
            //echo 'home';
            //var_dump($_args);
            $view = new HomeView();
        }

        public function Deal($_request) {
            //$data = $_SESSION['tran_sess'];
            $data = $_request['data'];
            
            $account = unserialize($_SESSION['account']);
            
            //var_dump($data);
            // 
            if ($data != null) {
                $susess = $account->StartDeal($data['purTime'], $data['purAmount'], $data['lever'], $data['purPrice'], $data['method']);
                if ($susess == true) {
                    echo 'deal susess';
                }
                else {
                    echo 'deal failed';
                }
            }
            else {
                echo 'no request data';
            }
            // 
            //Route::Redirect('home/');
        }

        public function Close($_request) {
            //$data = $_SESSION['tran_sess'];
            $data = $_request['data'];

            $account = unserialize($_SESSION['account']);
            
            if($account->CloseDeal($data['closeTime'],$data['closePrice'])) {

                echo 'close susess';
            };

            //Route::Redirect('home/');
        }

        public function Deposite($_request) {
            //$data = $_SESSION['tran_sess'];
            
            $account = unserialize($_SESSION['account']);
            
            $data = $_request['data'];

            if (isset($data['depositeAmount'])) {

                if($account->FillMoney($data['depositeAmount'])) {
                    echo 'deposite susess';
                }
                else echo 'deposite failed';
            }
            
            //
            
            //Route::redirect('logout/');
            //header('Content-Type: application/json');
            //echo json_encode($_GET['depositeAmount']);
        }
    }