<?php
    require_once 'autoload_map.php';

    class Autoloader {
        private static $autoLoaderObject;

        private $map;

        private function __construct() {
            $this->LoadMap();
        }

        private function LoadMap() {
            $this->map = include('autoload_map.php');

            return $this->map;
        }

        public function GetMap() {
            return $this->map;
        }

        private static function GetLoader() {
            if (self::$autoLoaderObject !== null) {
                return self::$autoLoaderObject;
            }

            self::$autoLoaderObject = new self();
            return self::$autoLoaderObject;
        }   

        public static function Load() {
            spl_autoload_register(function (string $_className) {
                $class_map = self::GetLoader()->map;
                //var_dump($class_map);
                //$class_map = $class_map->$map;

                $loaded_class = $class_map[$_className];

                if ($loaded_class !== null) {
                    include($loaded_class);
                }
            });
        }
    }