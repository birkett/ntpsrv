<?php

declare(strict_types=1);

namespace NtpSrv\classes\controller\health;

use stdClass;
use NtpSrv\classes\metrics\Cpu;

final class CpuHealthController extends AbstractHealthController
{
    /**
     * {@inheritDoc}
     */
    public function getRoute(): string
    {
        return '/health/cpu';
    }

    /**
     * {@inheritDoc}
     */
    public function get(): string
    {
        $cpu = new Cpu();
        $this->metrics->cpu = new stdClass();
        $this->metrics->cpu->used = $cpu->used();
        $this->metrics->cpu->total = $cpu->total();
        $this->metrics->cpu->percent = $cpu->percent();

        return parent::get();
    }
}
