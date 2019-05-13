<?php 
    class Curl {
        public static function RetrieveData($_url) {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $_url);
            $result = curl_exec($ch);
            curl_close($ch);

            $obj = json_decode($result,1);
            //echo $result;
            return $obj;
        }
    }