<?php
    class Model {
        protected $conn;

        public function __construct(string $_user, string $_pass, string $_db_instance) {
            $this->conn = oci_connect($_user, $_pass, 'localhost/'.$_db_instance);

            if (!$this->conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
        }

        public function Insert(string $_sql) {
            $resource = oci_parse($this->conn, $_sql);
            oci_execute($resource);
        }

        public function Select(string $_sql) {
            $resource = oci_parse($this->conn, $_sql);
            oci_execute($resource);

            $res = [];

            while ($row = oci_fetch_assoc($resource)) {
                $res[] = $row;
            }

            return $res;
        }
    }