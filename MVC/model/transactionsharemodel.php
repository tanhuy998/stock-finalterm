<?php 
    class TransactionShareModel extends Model {

        public function __construct() {
            parent::__construct('TRADER_STOCK', '1234', 'orcl');
        }

        public function GetAll() {

        }

        public function GetByID($_id) {
            $sql = 'SELECT ID,SHARE_NUM,TO_CHAR(TRADE_TIME, \'YYYY/MM/DD HH24:MI:SS\') AS TRADE_TIME FROM TRANSACTION_SHARE WHERE TRANSACTION_SHARE.ID = \''.$_id.'\'';

            return $this->Select($sql)[0];
        }

        public function GetByAccountID($_id) {
            $sql = 'SELECT ID,SHARE_NUM,TO_CHAR(TRADE_TIME, \'YYYY/MM/DD HH24:MI:SS\') AS TRADE_TIME FROM TRANSACTION_SHARE WHERE TRANSACTION_SHARE.ACCOUNT_ID = \''.$_id.'\'';

            return $this->Select($sql);
        }

        public function InsertSingle($_userID, $_amount, $_tran_type, $_percent, $_time) {
            $sql = 'INSERT INTO TRANSACTION_SHARE (ACCOUNT_ID, AMOUNT, STATUS, TRADE_TIME, TRAN_TYPE) VALUES (:id ,:amount, 0, TO_DATE(:time, \'YYYY/MM/DD HH24:MI:SS\'), :type)';

            $current_time = date('Y-m-d H:i:s');
            $typeID = intval(self::GetTransactionTypeID($_tran_type));


            $binding = [
                ':id' => $_userID,
                ':amount' => $_amount,
                ':type' => $typeID,
                ':time' => $current_time
            ];

            return $this->Insert($sql, $binding);
        }

        public function Delete() {

        }

        public static function GetTransactionTypeID(string $_type) {
            $sql = 'SELECT ID FROM TRANSACTION_TYPE WHERE TRANSACTION_TYPE.TYPE_NAME = \''.$_type.'\'';

            $model = new Model('TRADER_STOCK', '1234', 'orcl');
            //$binding_pairs[':type'] = $_type;

            $res = $model->Select($sql);

            return $res[0]['ID'];
        }

        public function GetUnclosedTransactionByAccountId($_id) {
            $sql = "SELECT * FROM TRANSACTION_SHARE WHERE TRANSACTION_SHARE.ACCOUNT_ID = $_id AND TRANSACTION_SHARE.STATUS = 0";

            return $this->Select($sql);
        }
    }