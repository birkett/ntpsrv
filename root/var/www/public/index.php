<?php

declare(strict_types=1);

namespace NtpSrv;

use NtpSrv\classes\Autoloader;
use NtpSrv\classes\controller\health\CpuHealthController;
use NtpSrv\classes\controller\health\DiskHealthController;
use NtpSrv\classes\controller\health\GpsHealthController;
use NtpSrv\classes\controller\health\MemHealthController;
use NtpSrv\classes\controller\IndexController;
use NtpSrv\classes\Router;

require_once '../classes/Autoloader.php';

Autoloader::init(['NtpSrv' => '../']);

$router = new Router([
    IndexController::class,
    CpuHealthController::class,
    MemHealthController::class,
    DiskHealthController::class,
    GpsHealthController::class,
]);

echo $router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
