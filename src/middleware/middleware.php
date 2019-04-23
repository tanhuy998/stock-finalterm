<?php
    class Middleware {
        protected $passStatus;

        public function __construct() {
            $this->passStatus = true;
        }

        public function Invoke() {

        }

        public function CanPass():bool {
            return $this->passStatus;
        }
        
    }