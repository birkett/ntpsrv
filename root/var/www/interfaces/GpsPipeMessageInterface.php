<?php

declare(strict_types=1);

namespace NtpSrv\interfaces;

interface GpsPipeMessageInterface
{
    public const MESSAGE_TYPE_PPS = 'PPS';
    public const MESSAGE_TYPE_TPV = 'TPV';

    /**
     * @return string
     */
    public function getClass(): string;

    /**
     * @return string
     */
    public function getDevice(): string;

    /**
     * @return string
     */
    public function getDisplayString(): string;
}
