<?php 
    //echo microtime();
    require_once 'src/define.php';
    require_once 'src/autoload/autoload.php';
    
    
    Router::Routes()->Add('test/', function ($data) {
        var_dump($data);

    })->SetMiddleware('TestMiddleware');

    Router::Routes()->Add('new/','TestController:Test');

    //Router::Redirect('test/', 'new/');

    //print_r($arr);
    // echo Router::Routes()->Exist('/foo');
    
    // echo Parser::ParseUri('/abc?a');

    $request = [];
    //echo $_SERVER['REQUEST_URI'];
    $request['uri'] = Parser::ParseRequestUri($_SERVER['REQUEST_URI']);
    $request['data'] = '123';

    //echo $request['uri'];
    Router::GetObject()->Map($request);

    //echo '<br>'.microtime();



