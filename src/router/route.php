<?php
    class Route {
        
        public static $ActionType = ['Anonymous' => 0, 'Controller' => 1];
        private static $ActionType_arr = ['Anonymous' , 'Controller'];

        private $uri;
        private $loadedMethod;
        private $middleware;
        private $redirectUri;
        private $meta;
        
        public function __construct() {
            $this->meta = ['ActionType' => '', 'LoadFunction' => '', 'Controller' => ''];
            return $this;
        }

        public function SetUri(string $_uri) {
            $this->uri = $_uri;
            
            return $this;
        }

        public function SetMiddleware($_middleware) {

            return $this;
        }

        public function SetRedirect($_uri) {
            $this->redirectUri = $_uri;

            return $this;
        }

        public function SetAction($_action) {
            if (is_callable($_action)) {
                $this->loadMethod = $_action;
            }
            if (is_string($_action)) {
                if (strpos($_action,':') != false) {

                    $arr = explode(':',$_action);
                    $controller = $arr[0];
                    $method = $arr[1];

                    $this->loadedMethod = $method;
                    $this->meta['Controller'] = $controller;
                }
            }
        }

        private function IsAnonymousAction() {
        
        }

        public function Load($args) {
            if ($this->meta['Controller'] == '') {
                $method = $this->loadMethod;
                if (is_callable($method)) {
                    $method($args);
                    //echo 'true';
                }
            }
            else {
                $Class_controller = $this->meta['Controller'];

                $controller = new $Class_controller();

                $method = $this->loadMethod;
                $controller->$method();
            }
        }

        private function LoadMiddleware() {
            $middleware = $this->middleware;

            if (!isset($middleware)) {
                return;
            }

            if (is_callable($middleware)) {

            }

            if (is_string($middleware)) {
                $middleware_list = explode(',',$middleware);

                foreach ($middleware_list as $mid) {

                    $mid();
                }
            }
        }

        public static function ActionType($_type) {
            if (isset(self::$ActionType[$_type])) {
                return  self::$ActionType[$_type];
            }
            return false;
        }

    }