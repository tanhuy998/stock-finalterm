<?php

    class HomeController {

        public function Index() {
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

            $view = new HomeView();
        }
    }