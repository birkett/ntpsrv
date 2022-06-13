<?php

declare(strict_types=1);

namespace NtpSrv\classes\metrics;

use NtpSrv\interfaces\MetricInterface;

abstract class AbstractMetric implements MetricInterface
{
    /**
     * @var float
     */
    protected float $usedValue;

    /**
     * @var float
     */
    protected float $totalValue;

    /**
     * {@inheritDoc}
     */
    public function used(): float
    {
        return $this->usedValue;
    }

    /**
     * {@inheritDoc}
     */
    public function total(): float
    {
        return $this->totalValue;
    }

    /**
     * {@inheritDoc}
     */
    public function percent(): float
    {
        return $this->used() / $this->total() * 100;
    }
}
