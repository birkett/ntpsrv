<?php

declare(strict_types=1);

namespace NtpSrv\classes\commands;

class Uname extends AbstractCommand
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct('uname', ['-a']);
    }
}
