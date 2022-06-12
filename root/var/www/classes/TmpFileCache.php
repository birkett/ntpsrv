<?php

declare(strict_types=1);

namespace NtpSrv\classes;

use DateTimeImmutable;
use NtpSrv\interfaces\CommandOutputCacheInterface;

final class TmpFileCache implements CommandOutputCacheInterface
{
    private const KEY_ROOT = 'NTPSRV_CC_';
    private const TIMESTAMP_KET_SUFFIX = '_TIMESTAMP';

    /**
     * {@inheritDoc}
     */
    public function get(string $key): ?string
    {
        $fullKey = $this->generateKey($key);
        $value = $this->readTmpFile($fullKey);
        $timestamp = $this->readTmpFile($fullKey . self::TIMESTAMP_KET_SUFFIX);

        return ($value && $timestamp && (new DateTimeImmutable(base64_decode($timestamp)) > new DateTimeImmutable()))
            ? base64_decode($value)
            : null;
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, string $value, string $expiryTime): void
    {
        $fullKey = $this->generateKey($key);
        $timestamp = (new DateTimeImmutable())->modify($expiryTime)->format(DATE_ATOM);

        $this->writeTmpFile($fullKey, base64_encode($value));
        $this->writeTmpFile($fullKey . self::TIMESTAMP_KET_SUFFIX, base64_encode($timestamp));
    }

    /**
     * @param string $key
     *
     * @return string
     */
    private function generateKey(string $key): string
    {
        $namespaceParts = explode('\\', $key);
        $lastPart = array_pop($namespaceParts);

        return self::KEY_ROOT . strtoupper($lastPart);
    }

    /**
     * @param string $key
     *
     * @return string|false
     */
    private function readTmpFile(string $key): string|bool
    {
        return file_get_contents($this->getTmpFileName($key));
    }

    /**
     * @param string $key
     * @param string $content
     *
     * @return void
     */
    private function writeTmpFile(string $key, string $content): void
    {
        file_put_contents($this->getTmpFileName($key), $content);
    }

    /**
     * @param string $key
     *
     * @return string
     */
    private function getTmpFileName(string $key): string
    {
        return sys_get_temp_dir() . '/' . $key;
    }
}
