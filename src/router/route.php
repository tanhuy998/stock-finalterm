<?php
    class Route {
        
        public static $ActionType = ['Anonymous' => 0, 'Controller' => 1];
        private static $ActionType_arr = ['Anonymous' , 'Controller'];

        private $uri;
        //private $loadedMethod;
        private $middleware;
        private $meta;
        
        public function __construct() {
            $this->meta = [];
            return $this;
        }

        public function SetUri(string $_uri) {
            $this->uri = $_uri;
            
            return $this;
        }

        public function SetMiddleware($_middleware) {

            return $this;
        }

        public function SetRedirect(string $_link) {
            $link = str_replace(' ', '', $_link);

            $this->meta['Redirect'] = $link;

            return $this;
        }

        public function SetAction($_action) {
            if (is_callable($_action)) {
                $this->meta['Method'] = $_action;
                //$this->loadMethod = $_action;
            }
            if (is_string($_action)) {
                $this->BindControllerAction($_action);
            }
        }

        private function BindControllerAction($_action) {
            if (strpos($_action,':') != false) {

                $arr = explode(':',$_action);
                $controller = $arr[0];
                $method = $arr[1];

                //$this->loadedMethod = $method;
                $this->meta['Method'] = $method;
                $this->meta['Controller'] = $controller;
            }
        }

        private function IsAnonymousAction() {
        
        }

        private function Redirect($_link) {

            if (filter_var($_link, FILTER_VALIDATE_URL) === true) {
                header('Location: '.$_link, true);
                exit();
            }
            else {
                //echo SUB_PATH_DOMAIN_NAME.$_link;

                header('Location: '.SUB_PATH_DOMAIN_NAME.$_link);
                //echo 1; 
                //exit();
            }

        }


        public function Render($_args) {
            if (isset($this->meta['Redirect'])) {
                $redirect_link = $this->meta['Redirect'];

                $this->Redirect($redirect_link);
            }

            if (!isset($this->meta['Controller'])) {

                $method = $this->meta['Method'];
                if (is_callable($method)) {

                    $this->InvokeAnonymousMethod($_args);
                    //$method($args);
                    //echo 'true';
                }
            }
            else {
                $this->InvokeControllerMethod($_args);
            }

        }

        private function InvokeAnonymousMethod($_args) {
            $method = $this->meta['Method'];

            $func_reflector = new ReflectionFunction($method);

            $paramNum = $func_reflector->GetNumberOfParameterS();

            if ($paramNum != 0) {
                $func_reflector->InvokeArgs($_args);
            }
            else {
                $func_reflector->Invoke();
            }
        }

        private function InvokeControllerMethod($_args) {
            $is_anonymous;

            //if (!$is_anonymous) {
                $Class_controller = $this->meta['Controller'];

                $controller = new $Class_controller();

                $method = $this->meta['Method'];

                $method_reflector = new ReflectionMethod($Class_controller, $method);

                $paramNum = $method_reflector->GetNumberOfParameters();

                if ($paramNum != 0) {
                    $method_reflector->InvokeArgs($controller,$_args);
                }
                else {
                    $method_reflector->Invoke($controller);
                }
            //}
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