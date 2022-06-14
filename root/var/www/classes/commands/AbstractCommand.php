<?php

declare(strict_types=1);

namespace NtpSrv\classes\commands;

use NtpSrv\interfaces\OutputCacheInterface;
use NtpSrv\classes\TmpFileCache;
use NtpSrv\interfaces\ConsoleCommand;

abstract class AbstractCommand implements ConsoleCommand
{
    /**
     * @var bool
     */
    protected bool $useOutputCache = true;

    /**
     * @var string
     */
    protected string $cacheTime = OutputCacheInterface::DEFAULT_CACHE_TIME;

    /**
     * @var string
     */
    private string $command;

    /**
     * @var string[]
     */
    private array $arguments;

    /**
     * @var OutputCacheInterface
     */
    private OutputCacheInterface $outputCache;

    /**
     * @param string $command
     * @param string[] $arguments
     */
    public function __construct(string $command, array $arguments = [])
    {
        $this->command = $command;
        $this->arguments = $arguments;
        $this->outputCache = new TmpFileCache();
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        if ($this->useOutputCache) {
            $content = $this->outputCache->get(static::class);

            if ($content) {
                return $content;
            }
        }

        $result = implode(PHP_EOL, $this->runCommand());

        if ($this->useOutputCache) {
            $this->outputCache->set(static::class, $result, $this->cacheTime);
        }

        return $result;
    }

    /**
     * @return string[]
     */
    private function runCommand(): array
    {
        $output = [];
        $arguments = $this->parseArguments();

        exec($this->command . ' ' . $arguments, $output);

        return $output;
    }

    /**
     * @return string
     */
    private function parseArguments(): string
    {
        return implode(' ', $this->arguments);
    }
}
