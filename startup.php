<?php 
    //echo microtime();
    session_start();
    require_once 'src/define.php';
    require_once 'src/autoload/autoload.php';
    
    

    Router::Routes()->Add('home/', 'HomeController:Index');//->SetMiddleware('Authenticator');

    //Router::Routes()->Add('new/','TestController:Test');

    //Router::Redirect('test/', 'new/');

    //print_r($arr);
    // echo Router::Routes()->Exist('/foo');
    
    // echo Parser::ParseUri('/abc?a');

    Router::SetHome('home/');

    $request = Parser::BindingRequest();
    //echo $_SERVER['REQUEST_URI'];
    // $request['uri'] = Parser::ParseRequestUri($_SERVER['REQUEST_URI']);
    // $request['data'][] = '123';

    //echo $request['uri'];
    $render_obj = Router::GetObject()->Map($request);

    $render_obj->Render($request['data']);

    session_abort();
    //echo '<br>'.microtime();



