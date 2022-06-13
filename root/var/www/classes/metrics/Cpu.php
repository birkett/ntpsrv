<?php

declare(strict_types=1);

namespace NtpSrv\classes\metrics;

final class Cpu extends AbstractMetric
{
    public function __construct()
    {
        $cpuIngo = file_get_contents('/proc/cpuinfo');
        preg_match_all('/^processor/m', $cpuIngo, $matches);

        $loadAverages = sys_getloadavg();

        $this->totalValue = (float) count($matches[0]);
        $this->usedValue = $loadAverages[0]; // Last 1 minute.
    }
}
