<?php
    define('CONTROLLER','\public\controller');
    define('MODEL','\public\model');
    define('VIEW','\public\view');
    define('ROUTE','\route');
    define('SUB_PATH_DOMAIN_NAME','/stock/');

    $ip = gethostbyname(gethostname());
    define('HOST_IP', $ip);
    $host = gethostbyaddr($ip);
    //echo $host;
    define('DOMAIN_NAME', $ip);

    define('DOMAIN', DOMAIN_NAME.SUB_PATH_DOMAIN_NAME);
