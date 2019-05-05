<?php
    class TransactionSession extends Middleware {

        public function __construct() {
            $this->passStatus = true;
        }

        public function Invoke($_args = null) {

            if (!isset($_SESSION['tran_sess'])) {
                $acc_id = $_args['acc_id'];
                $current_time = date('Y-m-d H:i:s');
                $tran_type = $_args['tran_type'];
                $produt_type = $_args['pro_type'];

                $data = [
                    'acc_id' => $acc_id,
                    'time' => $current_time,
                    'tran_type' => $tran_type,
                    'pro_type' => $produt_type
                ];
            }
            else {
                unset($_SESSION['tran_sess']);
            }
            
            return $this->meta;
        }

        public function CanPass():bool {
            return $this->passStatus;
        }

        public function GetMetaData() {
            return $this->meta;
        }

    }