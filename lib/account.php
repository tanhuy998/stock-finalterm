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

        public static function New(array $_data) {

            $username = $_data['username'];
            $pass = $_data['password'];

            $model = new AccountModel();

            if ($model->InsertSingle($username, $pass)) {

                $model = new Model('TRADER_STOCK','1234' , 'orcl');
                $sql = 'SELECT MAX(ID) AS ID FROM ACCOUNT';

                $new_user_id = $model->Select($sql)[0]['ID'];

                $model = new AccountInfoModel();

                $model->InsertSingle($new_user_id, $_data);

                $model = new AccountWalletModel();

                if ($model->InsertSingle($new_user_id)) {

                    $acc = new self($username, $pass);

                    if ($acc->IsValid()) {
                        $_SESSION['account'] = serialize($acc);

                        $token = Authentication::GenerateToken($new_user_id, $username);
                        Authentication::PlaceToken($token);
                    }
                    
                    return true;
                }
                else return false;
            }
            else return false;
        }

        public function FillMoney($_amount) {

            $curr_amount = $this->GetAmount();

            $new_amount = floatval($curr_amount) + floatval($_amount);

            $model = new AccountWalletModel();

            return $model->UpdateSingle($this->id, $new_amount);
        }

        public function StartDeal($_time, $_amount, $_percent, $_price, $_type) {
            $unclosed_deal = $this->GetUnclosedDeal();

            $budget = $this->GetAmount();

            $can_deal = (floatval($budget) >= floatval($_amount))? true : false;

            if ($unclosed_deal == null && $can_deal == true) {
            
                $model = new TransactionShareModel();

                $susess =  $model->InsertSingle($this->id, $_time, $_amount, $_percent, $_price, $_type);

                if ($susess == true) {
                    $money = '-'.$_amount;

                    return $this->FillMoney($money);
                }
                else return false;
            }

            return false;
        }

        public function CloseDeal($_time, $_price) {
            $unclosed_deal = $this->GetUnclosedDeal();

            if ($unclosed_deal) {

                $deal = $unclosed_deal[0];

                $deal_price = floatval($deal['PRICE']);
                $deal_amount = floatval($deal['AMOUNT']);
                $lever = intval($deal['LEVER']);
            
                $close_price = floatval($_price);

                $profit = (abs($close_price - $deal_price)/$close_price)*$lever;
                $profit *= $deal_amount;

                $type = intval($deal['TRAN_TYPE']);

                $total = ($type == 1 && $close_price >$deal_price)? $deal_amount + $profit: $deal_amount - $profit;

                if ($this->FillMoney($total)) {
                    $model = new TransactionShareModel();

                    return $model->UpdateUnclosed($this->id, $_time, $_price);
                }
                return false;
            }
            else return false;
        }

        private function GetUnclosedDeal() {
            $model = new TransactionShareModel();

            $user_id = $this->id;
            
            return $model->GetUnclosedTransactionByAccountID($user_id);
        }
    }