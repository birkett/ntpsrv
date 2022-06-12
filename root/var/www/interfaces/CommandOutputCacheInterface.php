<?php

declare(strict_types=1);

namespace NtpSrv\interfaces;

interface CommandOutputCacheInterface
{
    public const DEFAULT_CACHE_TIME = self::CACHE_TIME_1_SECOND;

    public const CACHE_TIME_1_SECOND = '+1 second';
    public const CACHE_TIME_30_SECONDS = '+30 second';

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function get(string $key): ?string;

    /**
     * @param string $key
     * @param string $value
     * @param string $expiryTime
     *
     * @return void
     */
    public function set(string $key, string $value, string $expiryTime): void;
}
