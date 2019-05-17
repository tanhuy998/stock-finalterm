<?php 
    //echo microtime();
    session_start();
    require_once 'src/define.php';
    require_once 'src/autoload/autoload.php';

    $http_host = $_SERVER['HTTP_HOST'];
    //echo $http_host = 'http://'.$http_host;

    $allow_origin = [
        'http://localhost', 
        'http://'.HOST_IP, 
        'http://'.DOMAIN_NAME
    ];

    if (in_array($http_host, $allow_origin)) {
        header("Access-Control-Allow-Origin: $http_host");
        header("Access-Control-Allow-Header: $http_host");
    }
    // Allow CORS for XHR request
    

    Router::Routes()->Add('home/', 'HomeController:Index')->SetMiddleware('Authentication');
    Router::Routes()->Add('home/deposite/', 'HomeController:Deposite')->SetMiddleware('TransactionSession-Authentication');
    Router::Routes()->Add('home/close/', 'HomeController:Close')->SetMiddleware('TransactionSession-Authentication');
    Router::Routes()->Add('home/deal/', 'HomeController:Deal')->SetMiddleware('TransactionSession-Authentication');
    Router::Routes()->Add('login/', 'LoginController:Index');
    Router::Routes()->Add('logout/', function($_request) {
        setcookie('token', '', 0, '/');
        
        Route::Redirect('home/');
    });
    Router::Routes()->Add('signup/', 'SignUpController:Index');
    Router::Routes()->Add('signup-reg', 'SignUpController:Sign');

    Router::Routes()->Add('temp/', function() {
        // $db = new Model('TRADER_STOCK','1234','orcl');

        // $sql = 'INSERT INTO TRANSACTION_TYPE (TYPE_NAME) VALUES (\'out\')';
            
        // //$db->Insert($sql);

        // $model = new Model('TRADER_STOCK', '1234', 'orcl');

        // $model->Insert($sql);

        //$res = $db->Select($sql);

        $acc = new Account('new3', '1234');

        $acc->StartDeal();
        //var_dump($id);
    });
    //Router::Routes()->Add('signin/', 'SigninController:Index');

    //Router::Routes()->Add('new/','TestController:Test');

    //Router::SetRedirect('test/', 'new/');

    //print_r($arr);
    // echo Router::Routes()->Exist('/foo');
    
    // echo Parser::ParseUri('/abc?a');

    Router::SetHome('home/');
    //echo '<1>';
    $request = Parser::BindingRequest();
    //echo $_SERVER['REQUEST_URI'];
    // $request['uri'] = Parser::ParseRequestUri($_SERVER['REQUEST_URI']);
    // $request['data'][] = '123';
    //echo $request['uri'];
    //echo $request['uri'];
    $route = Router::GetObject()->Map($request);
    //echo 5;
    
    if ($route !== null) {
        $route_stat = $route->LoadMiddleWare($request);
        //echo 4;
        //echo '<test>';
        if (isset($route_stat['redirect'])) {
            $link = $route_stat['redirect'];
            //echo $link;
            
            Route::Redirect($link);
        }
        else {
            //echo '<2>';
            //echo 7;
            if ($route_stat['status'] === true) {
                //echo 6;
                //echo '<4>';
                $route->Render($request);
            }
            else {
                echo '<5>';
            }
        }
    }
    else {
        //echo '<3>';
        Router::RedirectHttpCode('404');
    }
    

    //session_abort();
    //echo '<br>'.microtime();



