<?php

declare(strict_types=1);

namespace NtpSrv\classes\metrics;

final class Disk extends AbstractMetric
{
    public function __construct()
    {
        $this->totalValue = disk_total_space('/');
        $this->usedValue = $this->totalValue - disk_free_space('/');
    }
}
