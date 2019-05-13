<?php
    class TransactionSession extends Middleware {

        public function __construct() {
            $this->passStatus = true;
        }

        public function Invoke($_request) {

            // if (isset($_SESSION['tran_sess'])) {
            //     unset($_SESSION['tran_sess']);
            // }
            var_dump($_request);
            $this->meta['status'] = $this->passStatus;

            $data = $_request['data'];
            $session;

            if (isset($data['deposite'])) {
                unset($_SESSION['tran_sess']);
                $session = $this->FillMoneySession($data);
                $_SESSION['tran_sess'] = $session;
            }
            else if (isset($data['call']) || isset($data['put'])) {
                unset($_SESSION['tran_sess']);
                $session = $this->DealSession($data);
                $_SESSION['tran_sess'] = $session;
            }
            else if (isset($data['close'])) {
                unset($_SESSION['tran_sess']);
                $session = $this->CloseDealSession($data);
                $_SESSION['tran_sess'] = $session;
            }

            echo 'session';
            
            //$this->meta['redirect']
            return $this->meta;
        }

        private function FillMoneySession($_data) {
            
            $amount = $_data['amount'];

            return $session = [
                'amount' => $amount,
                'session_type' => 'deposite'
            ];
        }

        private function DealSession($_data) {
            
            $tran_time = $_data['time'];
            $amount = $_data['amount'];
            $percent = $_data['percent'];

            return $session = [
                'time' => $tran_time,
                'amount' => $amount,
                'percent' => $percent,
                'session_type' => 'deal'
            ];
        }

        private function CloseDealSession($_data) {
            
            $tran_time = $_data['time'];

            return $session = [
                'time' => $tran_time,
                'session_type' => 'close'
            ];
        }

        public function CanPass():bool {
            return $this->passStatus;
        }

        public function GetMetaData() {
            return $this->meta;
        }

    }