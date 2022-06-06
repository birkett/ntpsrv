<?php

declare(strict_types=1);

namespace NtpSrv;

use NtpSrv\classes\Autoloader;
use NtpSrv\classes\commands\Uname;
use NtpSrv\classes\Template;
use NtpSrv\classes\commands\Date;
use NtpSrv\classes\commands\Uptime;

require_once '../classes/Autoloader.php';

$autoloader = new Autoloader([
    'NtpSrv' => '../',
]);

$autoloader->init();

$template = new Template(__DIR__ . '/../templates/index.html.tpl', [
    'uname' => (new Uname())->getOutput(),
    'uptime' => (new Uptime())->getOutput(),
    'date' => (new Date())->getOutput(),
]);

echo $template->render();
