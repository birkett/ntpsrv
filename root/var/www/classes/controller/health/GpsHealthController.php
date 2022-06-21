<?php

declare(strict_types=1);

namespace NtpSrv\classes\controller\health;

use stdClass;
use NtpSrv\classes\commands\GpsPipe;
use NtpSrv\interfaces\OutputCacheInterface;

final class GpsHealthController extends AbstractHealthController
{
    public function __construct()
    {
        parent::__construct();

        $this->setCacheTime(OutputCacheInterface::CACHE_TIME_60_SECONDS);
    }

    /**
     * {@inheritDoc}
     */
    public function getRoute(): string
    {
        return '/health/gps';
    }

    /**
     * {@inheritDoc}
     */
    public function get(): string
    {
        $gps = new GpsPipe();
        $gps->getOutput();

        $this->metrics->gps = new stdClass();
        $this->metrics->gps->locked = $gps->isLocked();

        return parent::get();
    }
}
