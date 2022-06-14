<?php

declare(strict_types=1);

namespace NtpSrv\traits;

use NtpSrv\interfaces\OutputCacheInterface;

trait CachedOutputTrait
{
    /**
     * @var string
     */
    protected string $cacheTime = OutputCacheInterface::DEFAULT_CACHE_TIME;

    /**
     * @var OutputCacheInterface|null
     */
    protected ?OutputCacheInterface $outputCache;

    /**
     * @var bool
     */
    private bool $useOutputCache = true;

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function cacheGet(string $key): ?string
    {
        return $this->useOutputCache && $this->outputCache instanceof OutputCacheInterface
            ? $this->outputCache->get($key)
            : null;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function cacheSet(string $key, string $value): void
    {
        if ($this->useOutputCache && $this->outputCache instanceof OutputCacheInterface) {
            $this->outputCache->set($key, $value, $this->cacheTime);
        }
    }
}
