<?php 
    //require_once '../define.php';

    $base_path = dirname(dirname(__DIR__));
    
    return [
        'HomeController' => $base_path.'\MVC\controller\HomeController.php',
        'Router' => $base_path.'\src\router\router.php',
        'RouteMap' => $base_path.'\src\router\routemap.php',
        'Route' => $base_path.'\src\router\route.php',
        'Parser' => $base_path.'\src\parsing\parser.php',
        'Middleware' => $base_path.'\src\middleware\middleware.php',
        'Authenticator' => $base_path.'\MVC\middleware\authenticator.php',
    ];