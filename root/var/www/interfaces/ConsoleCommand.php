<?php

declare(strict_types=1);

namespace NtpSrv\interfaces;

interface ConsoleCommand
{
    /**
     * @return string
     */
    public function getOutput(): string;
}
