<?php

declare(strict_types=1);

namespace NtpSrv\classes\metrics;

final class Disk extends AbstractMetric
{
    private const DEVICE = '/';

    public function __construct()
    {
        $this->totalValue = disk_total_space(self::DEVICE);
        $this->usedValue = $this->totalValue - disk_free_space(self::DEVICE);
    }

    /**
     * @return string
     */
    public function getDevice(): string
    {
        return self::DEVICE;
    }
}
