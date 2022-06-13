<?php

declare(strict_types=1);

namespace NtpSrv\interfaces;

interface MetricInterface
{
    /**
     * Get a metrics used value.
     *
     * @return float
     */
    public function used(): float;

    /**
     * Get a metrics total value.
     *
     * @return float
     */
    public function total(): float;

    /**
     * Get a metrics percent value.
     *
     * @return float
     */
    public function percent(): float;
}
