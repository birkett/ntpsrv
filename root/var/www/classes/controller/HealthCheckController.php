<?php

declare(strict_types=1);

namespace NtpSrv\classes\controller;

use stdClass;
use NtpSrv\classes\metrics\Cpu;
use NtpSrv\classes\metrics\Disk;
use NtpSrv\classes\metrics\Mem;

final class HealthCheckController extends AbstractController
{
    /**
     * {@inheritDoc}
     */
    public function getRoute(): string
    {
        return '/health';
    }

    /**
     * {@inheritDoc}
     */
    public function get(): string
    {
        $this->setContentType(self::CONTENT_TYPE_JSON);

        $cpu = new Cpu();
        $disk = new Disk();
        $mem = new Mem();

        $metrics = new stdClass();

        $metrics->cpu = new stdClass();
        $metrics->cpu->used = $cpu->used();
        $metrics->cpu->total = $cpu->total();
        $metrics->cpu->percent = $cpu->percent();

        $metrics->disk = new stdClass();
        $metrics->disk->used = $disk->used();
        $metrics->disk->total = $disk->total();
        $metrics->disk->percent = $disk->percent();

        $metrics->mem = new stdClass();
        $metrics->mem->used = $mem->used();
        $metrics->mem->total = $mem->total();
        $metrics->mem->percent = $mem->percent();

        return json_encode($metrics, JSON_THROW_ON_ERROR);
    }
}
