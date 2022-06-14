<?php

declare(strict_types=1);

namespace NtpSrv\classes\commands;

use NtpSrv\interfaces\OutputCacheInterface;

final class Ntpq extends AbstractCommand
{
    protected string $cacheTime = OutputCacheInterface::CACHE_TIME_30_SECONDS;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct('ntpq', ['-p']);
    }
}
