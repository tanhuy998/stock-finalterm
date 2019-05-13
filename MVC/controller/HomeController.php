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
            $data = $_SESSION['tran_sess'];
            
            $account = $_SESSION['account'];
            
            $account->StartDeal($data['time'], $data['amount'], $data['percent']);

            Route::Redirect('home/');
        }

        public function Close($_request) {
            $data = $_SESSION['tran_sess'];
            
            $account = $_SESSION['account'];
            
            $account->CloseDeal($data['time']);

            Route::Redirect('home/');
        }

        public function Deposite($_request) {
            $data = $_SESSION['tran_sess'];
            
            $account = $_SESSION['account'];
            
            $account->FillMoney($data['amount']);

            Route::redirect('home/');
        }
    }