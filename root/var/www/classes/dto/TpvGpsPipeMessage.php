<?php

declare(strict_types=1);

namespace NtpSrv\classes\dto;

use DateTimeImmutable;
use Exception;

final class TpvGpsPipeMessage extends AbstractGpsPipeMessage
{
    /**
     * @var int
     */
    protected int $mode = 0;

    /**
     * @var string
     */
    protected string $time = 'now';

    /**
     * @var float
     */
    protected float $ept = 0.0;

    /**
     * @var float
     */
    protected float $lat = 0.0;

    /**
     * @var float
     */
    protected float $lon = 0.0;

    /**
     * @var float
     */
    protected float $altHAE = 0.0;

    /**
     * @var float
     */
    protected float $altMSL = 0.0;

    /**
     * @var float
     */
    protected float $alt = 0.0;

    /**
     * @var float
     */
    protected float $epx = 0.0;

    /**
     * @var float
     */
    protected float $epy = 0.0;

    /**
     * @var float
     */
    protected float $epv = 0.0;

    /**
     * @var float
     */
    protected float $magvar = 0.0;

    /**
     * @var float
     */
    protected float $speed = 0.0;

    /**
     * @var float
     */
    protected float $climb = 0.0;

    /**
     * @var float
     */
    protected float $eps = 0.0;

    /**
     * @var float
     */
    protected float $epc = 0.0;

    /**
     * @var float
     */
    protected float $geoidSep = 0.0;

    /**
     * @var float
     */
    protected float $eph = 0.0;

    /**
     * @var float
     */
    protected float $sep = 0.0;

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * @return DateTimeImmutable
     *
     * @throws Exception
     */
    public function getTime(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->time);
    }

    /**
     * @return float
     */
    public function getEpt(): float
    {
        return $this->ept;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->lon;
    }

    /**
     * @return float
     */
    public function getAltHae(): float
    {
        return $this->altHAE;
    }

    /**
     * @return float
     */
    public function getAltMsl(): float
    {
        return $this->altMSL;
    }

    /**
     * @return float
     */
    public function getAltitude(): float
    {
        return $this->alt;
    }

    /**
     * @return float
     */
    public function getEpx(): float
    {
        return $this->epx;
    }

    /**
     * @return float
     */
    public function getEpy(): float
    {
        return $this->epy;
    }

    /**
     * @return float
     */
    public function getEpv(): float
    {
        return $this->epv;
    }

    /**
     * @return float
     */
    public function getMagVar(): float
    {
        return $this->magvar;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @return float
     */
    public function getClimb(): float
    {
        return $this->climb;
    }

    /**
     * @return float
     */
    public function getEps(): float
    {
        return $this->eps;
    }

    /**
     * @return float
     */
    public function getEpc(): float
    {
        return $this->epc;
    }

    /**
     * @return float
     */
    public function getGeoIdSep(): float
    {
        return $this->geoidSep;
    }

    /**
     * @return float
     */
    public function getEph(): float
    {
        return $this->eph;
    }

    /**
     * @return float
     */
    public function getSep(): float
    {
        return $this->sep;
    }

    /**
     * {@inheritDoc}
     */
    public function getDisplayString(): string
    {
        return sprintf(
            'Lat: %f, Lon: %f, Alt: %f',
            $this->getLatitude(),
            $this->getLongitude(),
            $this->getAltitude(),
        );
    }
}
