<?php

    class HomeController {

        public function Index() {
            //echo 'fuck yeah'.$_temp;

            //echo __DIR__;
            $db = new Model('TRADER_STOCK','1234','orcl');

            $sql = 'INSERT INTO ACCOUNT (ID,ACCOUNT_NAME,PASSWORD) VALUES (2,\'trade2\',\'123\')';
            
            //$db->Insert($sql);

            $sql = 'SELECT * FROM ACCOUNT';

            $res = $db->Select($sql);

            var_dump($res);
        }
    }