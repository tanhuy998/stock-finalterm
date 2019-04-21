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

        public function Render(array $_request) {
            $uri = $_request['uri'];
            $request_data = $_request['data'];

            if ($this->ExistsRoute($uri)) {
                $route = $this->routes;
                //
                $route->$uri($request_data);    
            }
            //else return redirect('404');
        }

        public function Redirect($_uri) {
            $error_list = include('http_status.php');

            if (isset($error_list[$_uri])) {
                $show_error = $error_list[$_uri];

                $show_error();
            }

            $redirect_url = DOMAIN_NAME.$_uri;

            header('Location: '.$redirect_url);
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
