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

        public static function ParseInitURI(string $_uri) {
            $uri = str_replace(SUB_PATH_DOMAIN_NAME, '', $_uri);

            $pattern = '/\([a-zA-Z0-9]+\)/';

            if (preg_match($pattern,$uri,$matches)) {
                
            }

            else return $uri;
        }

        public static function BindingRequest() {
            $request = [];
            $server = $_SERVER;

            $request['uri'] = self::ParseRequestUri($server['REQUEST_URI']);
            
            if ($server['REQUEST_METHOD'] == 'GET') {
                $request['data'] = $_GET;
            }
            else if ($server['REQUEST_METHOD'] == 'POST') {
                $request['data'] = $_POST;
            }

            return $request;
        }
    }