<?php 
    //require_once '../define.php';

    $base_path = dirname(dirname(__DIR__));
    
    return [
        'TestController' => $base_path.'\MVC\controller\TestController.php',
        'Router' => $base_path.'\src\router\router.php',
        'RouteMap' => $base_path.'\src\router\routemap.php',
        'Route' => $base_path.'\src\router\route.php',
        'Parser' => $base_path.'\src\parsing\parser.php',
    ];