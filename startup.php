<?php 
    //echo microtime();
    require_once 'src/define.php';
    require_once 'src/autoload/autoload.php';
    
    
    Router::Routes()->Add('/test', function ($data) {
        var_dump($data);
    });

    Router::Routes()->Add('/con','TestController:Test');

    //print_r($arr);
    echo Router::Routes()->Exist('/foo');

    echo Parser::ParseUri('/abc?a');

    $request = [
        'uri' => '/con',
        'data' => '1234',
    ];

    Router::GetObject()->Render($request);

    //echo '<br>'.microtime();



