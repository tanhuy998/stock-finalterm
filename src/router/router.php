<?php
    // require_once '../autoload/autoload.php';
    // require_once 'Singleton.php';
    // require_once 'route_map.php';

    /**
     * ------------------------------------------------------------------------------------
     *      Class router define router for 
     * ------------------------------------------------------------------------------------
     */
    class Router {
        private static $router;

        private $routes;

        //private static $router;

        private function __construct() {
            $this->routes = new RouteMap();
        }

        public function SetRoute(string $_uri, $action) {
            if(!$this->ExistsRoute($_uri)) {
                return false;
            }

            $new_route = new Route();
            
            $new_route->Uri($_uri);
            $new_route->LoadMethod($_action);

            $this->map[$_uri] = $new_route;

            return $this->map[$_uri];
        }

        public function Route($_uri){

        }

        public function Map(array $_request) {
            $uri = $_request['uri'];
            $request_data = $_request['data'];

            if ($this->ExistsRoute($uri)) {
                $routes = $this->routes;
                //
                //var_dump($uri);
                //echo $uri;
                $routes->$uri($request_data);    
            }
            else return $this->redirectHttpCode('404');
        }

        private function RedirectHttpCode($_code) {
            $supported_respone_code = include('http_status.php');

            if (isset($supported_respone_code[$_code])) {
                $code = intval($_code);
                http_response_code($code);

                echo '<h1>404</h1>';
            }
            
            return false;
        }

        private function ExistsRoute(string $_uri):bool {
            return $this->routes->Exist($_uri);
        }

        public static function GetObject() {
            if (self::$router !== null) {
                return self::$router;
            }

            self::$router = new self();
            return self::$router;

        }
        
        public static function New($uri, $_action) {
            
            self::$router->SetRoute($uri, $_action);

        }

        public static function Routes() {
            return self::GetObject()->routes;
        }

    }
