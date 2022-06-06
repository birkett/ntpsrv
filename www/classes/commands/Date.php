<?php

declare(strict_types=1);

namespace NtpSrv\classes\commands;

class Date extends AbstractCommand
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct('date');
    }
}
