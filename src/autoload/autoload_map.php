<?php 
    //require_once '../define.php';

    $base_path = dirname(dirname(__DIR__));
    
    return [
        'AccountInfoModel' => $base_path.'\MVC\model\accountinfomodel.php',
        'SignUpView' => $base_path.'\MVC\view\signup.php',
        'SignUpController' => $base_path.'\MVC\controller\signupcontroller.php',
        'Curl' => $base_path.'\lib\curl.php',
        'AccountWalletModel' => $base_path.'\MVC\model\accountwalletmodel.php',
        'TransactionSession' => $base_path.'\MVC\middleware\transactionsession.php',
        'TradingController' => $base_path.'\MVC\model\tradingcontroller.php',
        'TransactionShareModel' => $base_path.'\MVC\model\transactionsharemodel.php',
        'HomeView' => $base_path.'\MVC\view\home.php',
        'SigninView' => $base_path.'\MVC\view\signin.php',
        'LoginController' => $base_path.'\MVC\controller\logincontroller.php',
        'Account' => $base_path.'\lib\account.php',
        'AccountModel' => $base_path.'\MVC\model\accountmodel.php',
        'Model' => $base_path.'\MVC\model\model.php',
        'HomeController' => $base_path.'\MVC\controller\HomeController.php',
        'Router' => $base_path.'\src\router\router.php',
        'RouteMap' => $base_path.'\src\router\routemap.php',
        'Route' => $base_path.'\src\router\route.php',
        'Parser' => $base_path.'\src\parsing\parser.php',
        'Middleware' => $base_path.'\src\middleware\middleware.php',
        'Authentication' => $base_path.'\MVC\middleware\authentication.php',
    ];