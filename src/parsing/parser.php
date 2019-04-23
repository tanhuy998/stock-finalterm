<?php 
    class Parser {

        public static function ParseUri(string $_uri) {
            if (strpos($_uri, '?') > 0) {
                $arr = explode('?', $_uri);

                $str_route = $arr[0];

                return $str_route;
            }

            return $_uri;
        }

    }