<?php 
    class AccountWalletModel extends Model {

        public function __construct() {
            parent::__construct('TRADER_STOCK', '1234', 'orcl');
        }

        public function GetbyID($id) {
            $sql = "SELECT * FROM ACCOUNT_WALLET WHERE ACCOUNT_WALLET.ACCOUNT_ID = '$id'";

            return $this->Select($sql)[0];
        }
        
        public function InsertSingle($_user_id) {
            $sql = "INSERT INTO ACCOUNT_WALLET(AMOUNT, ACCOUNT_ID) VALUES (0, $_user_id)";

            return $this->Insert($sql);
        }

        public function UpdateSingle($_user_id, $_amount) {

            $sql = 'UPDATE ACCOUNT_WALLET SET AMOUNT = :amount WHERE ACCOUNT_WALLET.ACCOUNT_ID = :id';

            $pairs = [
                ':id' => $_user_id, 
                ':amount' => $_amount
            ];

            return $this->Update($sql, $pairs);
        }
    }