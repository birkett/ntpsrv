<?php

declare(strict_types=1);

namespace NtpSrv\classes\controller\health;

use stdClass;
use NtpSrv\classes\metrics\Disk;

final class DiskHealthController extends AbstractHealthController
{
    /**
     * {@inheritDoc}
     */
    public function getRoute(): string
    {
        return '/health/disk';
    }

    /**
     * {@inheritDoc}
     */
    public function get(): string
    {
        $disk = new Disk();
        $this->metrics->disk = new stdClass();
        $this->metrics->disk->used = $disk->used();
        $this->metrics->disk->total = $disk->total();
        $this->metrics->disk->percent = $disk->percent();
        $this->metrics->disk->device = $disk->getDevice();

        return parent::get();
    }
}
