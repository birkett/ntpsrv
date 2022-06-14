<?php

declare(strict_types=1);

namespace NtpSrv\classes\commands;

use NtpSrv\interfaces\OutputCacheInterface;

final class Ntpq extends AbstractCommand
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct('ntpq', ['-p']);

        $this->setCacheTime(OutputCacheInterface::CACHE_TIME_30_SECONDS);
    }
}
