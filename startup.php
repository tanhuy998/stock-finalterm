<?php 
    require_once 'src/autoload/autoload.php';
    
    Router::Routes()->New('/test','func');

    $arr = Router::Routes();

    print_r($arr);
    
