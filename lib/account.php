<?php
    class Account {
        private $valid;
        private $id;
    
        public function __construct(string $_username, string $_password) {
            $this->valid = false;
            
            $this->valid = $this->Authenticate($_username, $_password);
        }

        public function GetId() {
            return $this->id;
        }

        private function Authenticate(string $_username, string $_password): bool {
            $model =  new AccountModel();

            $account = $model->GetByUserName($_username);

            //var_dump($account);

            if (isset($account)) {
                $hash_pass = $account['PASSWORD'];
                $hash_pass = str_replace(' ', '', $hash_pass);

                if (password_verify($_password, $hash_pass)) {
                    $this->id = $account['ID'];
                    
                    //echo 'verify';

                    return true;
                };
            }

            return false;
        }

        public function IsValid():bool {
            return $this->valid;
        }

        public function GetAmount() {
            if ($this->valid === true) {
                $id = $this->id;

                $model = new AccountWalletModel();

                $wallet = $model->GetByID($id);

                return $wallet['AMOUNT'];
            }
        }

        public static function New(string $_name, string $_pass) {

            $model = new AccountModel();

            if ($model->InsertSingle($_name, $_pass)) {
                $model = new Model('TRADER_STOCK','1234' , 'orcl');
                $sql = 'SELECT MAX(ID) AS ID FROM ACCOUNT';

                $new_user_id = $model->Select($sql)[0]['ID'];

                $model = new AccountWalletModel();

                
                return $model->InsertSingle($new_user_id);
            }
            
            return false;
        }

        public function FillMoney($_amount) {

            $curr_amount = $this->GetAmount();

            $new_amount = floatval($curr_amount) + floatval($_amount);

            $model = new AccountWalletModel();

            return $model->UpdateSingle($this->id, $new_amount);
        }

        public function StartDeal($_time, $_amount, $_percent) {
            $unclosed_deal = $this->GetUnclosedDeal();

            $date;

            if ($unclosed_deal == null) {
            
                $model = new TransactionShareModel();

                
            }

        }

        public function CloseDeal($_time) {
            
        }

        private function GetUnclosedDeal() {
            $model = new TransactionShareModel();

            $user_id = $this->id;
            
            return $model->GetUnclosedTransactionByAccountID($user_id);
        }
    }