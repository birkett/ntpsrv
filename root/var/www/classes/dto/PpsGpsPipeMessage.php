<?php

declare(strict_types=1);

namespace NtpSrv\classes\dto;

final class PpsGpsPipeMessage extends AbstractGpsPipeMessage
{
    /**
     * @var int
     */
    protected int $real_sec = 0;

    /**
     * @var int
     */
    protected int $real_nsec = 0;

    /**
     * @var int
     */
    protected int $clock_sec = 0;

    /**
     * @var int
     */
    protected int $clock_nsec = 0;

    /**
     * @var int
     */
    protected int $precision = 0;

    /**
     * @return int
     */
    public function getRealSeconds(): int
    {
        return $this->real_sec;
    }

    /**
     * @return int
     */
    public function getRealNSeconds(): int
    {
        return $this->real_nsec;
    }

    /**
     * @return int
     */
    public function getClockSeconds(): int
    {
        return $this->clock_sec;
    }

    /**
     * @return int
     */
    public function getClockNSeconds(): int
    {
        return $this->clock_nsec;
    }

    /**
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }

    /**
     * {@inheritDoc}
     */
    public function getDisplayString(): string
    {
        return sprintf(
            'PPS locked, precision %d, time %d',
            $this->getPrecision(),
            $this->getRealSeconds(),
        );
    }
}
