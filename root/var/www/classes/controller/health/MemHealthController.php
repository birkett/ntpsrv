<?php

declare(strict_types=1);

namespace NtpSrv\classes\controller\health;

use stdClass;
use NtpSrv\classes\metrics\Mem;

final class MemHealthController extends AbstractHealthController
{
    /**
     * {@inheritDoc}
     */
    public function getRoute(): string
    {
        return '/health/mem';
    }

    /**
     * {@inheritDoc}
     */
    public function get(): string
    {
        $mem = new Mem();
        $this->metrics->mem = new stdClass();
        $this->metrics->mem->used = $mem->used();
        $this->metrics->mem->total = $mem->total();
        $this->metrics->mem->percent = $mem->percent();

        return parent::get();
    }
}
