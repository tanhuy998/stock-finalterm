<?php 
    class Parser {

        public static function ParseRequestUri(string $_uri) {
            $uri = str_replace(SUB_PATH_DOMAIN_NAME, '', $_uri);

            if (strpos($uri, '?') > 0) {
                $arr = explode('?', $_uri);

                $str_route = $arr[0];

                return $str_route;
            }

            return $uri;
        }
    }