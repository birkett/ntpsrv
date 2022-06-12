<?php

declare(strict_types=1);

namespace NtpSrv;

use NtpSrv\classes\Autoloader;
use NtpSrv\classes\commands\Ntpq;
use NtpSrv\classes\commands\Uname;
use NtpSrv\classes\Template;
use NtpSrv\classes\commands\Date;
use NtpSrv\classes\commands\Uptime;
use NtpSrv\classes\commands\GpsPipe;

require_once '../classes/Autoloader.php';

Autoloader::init(['NtpSrv' => '../']);

$template = new Template(__DIR__ . '/../templates/index.html.tpl', [
    'uname' => (new Uname())->getOutput(),
    'uptime' => (new Uptime())->getOutput(),
    'date' => (new Date())->getOutput(),
    'gpspipe' => (new GpsPipe())->getOutput(),
    'ntpq' => (new Ntpq())->getOutput(),
]);

echo $template->render();
