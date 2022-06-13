<?php

declare(strict_types=1);

namespace NtpSrv\classes\metrics;

final class Mem extends AbstractMetric
{
    public function __construct()
    {
        $memInfo = file_get_contents('/proc/meminfo');
        preg_match_all('/(\w+):\s+(\d+)\s/', $memInfo, $matches);
        $info = array_combine($matches[1], $matches[2]);

        $this->totalValue = (float) $info['MemTotal'];
        $this->usedValue = $this->totalValue - (float) $info['MemAvailable'];
    }
}
