<?php 
    //echo microtime();
    require_once 'src/autoload/autoload.php';
    require_once 'src/define.php';
    
    Router::Routes()->Add('/test', function ($data) {
        var_dump($data);
    });

    Router::Routes()->Add('/con','TestController:Test');

    //print_r($arr);
    echo Router::Routes()->Exist('/foo');

    $request = [
        'uri' => '/con',
        'data' => '1234',
    ];

    Router::GetObject()->Render($request);

    //echo '<br>'.microtime();



