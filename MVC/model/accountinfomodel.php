<?php 
    class AccountInfoModel extends Model {
        public function __construct() {
            parent::__construct('TRADER_STOCK', '1234', 'orcl');
        }

        public function InsertSingle($_id, $_data) {
            $sql = <<<SQL
                INSERT INTO ACCOUNT_INFORMATION
                (NAME, BIRTHDAY, ADDRESS, ACCOUNT_ID)
                VALUES
                (:name, TO_DATE(:birth, 'YYYY-MM-DD'), :addr, :id)
SQL;

            $binding = [
                ':name' => $_data['fullname'],
                ':birth' => $_data['birthday'],
                ':addr' => $_data['address'],
                ':id' => $_id
            ];

            return $this->Insert($sql, $binding);
        }
    }