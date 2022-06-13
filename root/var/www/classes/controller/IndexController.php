<?php

declare(strict_types=1);

namespace NtpSrv\classes\controller;

use NtpSrv\classes\commands\Date;
use NtpSrv\classes\commands\GpsPipe;
use NtpSrv\classes\commands\Ntpq;
use NtpSrv\classes\commands\Uname;
use NtpSrv\classes\commands\Uptime;
use NtpSrv\classes\Template;

final class IndexController extends AbstractController
{
    /**
     * {@inheritDoc}
     */
    public function getRoute(): string
    {
        return '/';
    }

    /**
     * {@inheritDoc}
     */
    public function get(): string
    {
        $template = new Template(__DIR__ . '/../../templates/index.html.tpl', [
            'uname' => (new Uname())->getOutput(),
            'uptime' => (new Uptime())->getOutput(),
            'date' => (new Date())->getOutput(),
            'gpspipe' => (new GpsPipe())->getOutput(),
            'ntpq' => (new Ntpq())->getOutput(),
        ]);

        return $template->render();
    }
}
