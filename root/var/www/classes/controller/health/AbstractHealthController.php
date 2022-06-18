<?php

declare(strict_types=1);

namespace NtpSrv\classes\controller\health;

use stdClass;
use NtpSrv\classes\controller\AbstractController;
use NtpSrv\classes\TmpFileCache;
use NtpSrv\interfaces\OutputCacheInterface;
use NtpSrv\traits\CachedOutputTrait;

abstract class AbstractHealthController extends AbstractController
{
    use CachedOutputTrait;

    /**
     * @var stdClass
     */
    protected stdClass $metrics;

    public function __construct()
    {
        parent::__construct();

        $this->setOutputCache(new TmpFileCache());
        $this->setCacheTime(OutputCacheInterface::CACHE_TIME_10_SECONDS);

        $this->metrics = new stdClass();
    }

    /**
     * {@inheritDoc}
     */
    public function get(): string
    {
        $this->setContentType(self::CONTENT_TYPE_JSON);

        $content = $this->cacheGet(static::class);

        if ($content) {
            return $content;
        }

        $result = json_encode($this->metrics, JSON_THROW_ON_ERROR);

        $this->cacheSet(static::class, $result);

        return $result;
    }
}
