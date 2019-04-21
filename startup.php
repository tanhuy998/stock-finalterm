<?php 
    //echo microtime();
    require_once 'src/autoload/autoload.php';
    
    Router::Routes()->New('/test', function ($data) {
        var_dump($data);
    });

    //print_r($arr);
    echo Router::Routes()->Exist('/foo');

    $request = [
        'uri' => '/test',
        'data' => '1234',
    ];

    Router::GetObject()->Render($request);

    //echo '<br>'.microtime();



