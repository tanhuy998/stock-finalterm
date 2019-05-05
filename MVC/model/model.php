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

        public function __destruct() {
            if ($this->conn) {
                oci_close($this->conn);
            }
        }

        private function BindValues($stid , array $_binding_pairs) {
            foreach ($_binding_pairs as $key => $value) {
                //echo $key.' '.$value.'<br>';
                oci_bind_by_name($stid, $key, $_binding_pairs[$key]);
            }

            return $stid;
        }

        public function Insert(string $_sql, array $_binding_pairs = []) {
            $resource = oci_parse($this->conn, $_sql);

            $res = $this->BindValues($resource, $_binding_pairs);
            
            //var_dump($resource);
            return oci_execute($res);
        }

        public function Select(string $_sql, array $_binding_pairs = []) {
            $resource = oci_parse($this->conn, $_sql);

            $res = $this->BindValues($resource, $_binding_pairs);
            
            oci_execute($res);

            $return_val = [];
            //echo oci_num_rows($resource);
            while ($row = oci_fetch_assoc($res)) {
                //var_dump($row);
                $return_val[] = $row;
            }
            
            return $return_val;
        }
    }