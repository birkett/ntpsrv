<?php

declare(strict_types=1);

namespace NtpSrv;

use NtpSrv\classes\Autoloader;
use NtpSrv\classes\controller\HealthCheckController;
use NtpSrv\classes\controller\IndexController;
use NtpSrv\classes\Router;

require_once '../classes/Autoloader.php';

Autoloader::init(['NtpSrv' => '../']);

$router = new Router([
    IndexController::class,
    HealthCheckController::class,
]);

echo $router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
