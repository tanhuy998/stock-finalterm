<?php
    class Middleware {
        protected $passStatus;

        public function __construct() {
            $this->passStatus = true;
        }

        public function Invoke($_args = null) {

        }

        public function CanPass():bool {
            return $this->passStatus;
        }
        
    }