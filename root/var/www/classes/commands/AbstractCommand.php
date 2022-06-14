<?php

declare(strict_types=1);

namespace NtpSrv\classes\commands;

use NtpSrv\classes\TmpFileCache;
use NtpSrv\interfaces\ConsoleCommand;
use NtpSrv\traits\CachedOutputTrait;

abstract class AbstractCommand implements ConsoleCommand
{
    use CachedOutputTrait;

    /**
     * @var string
     */
    private string $command;

    /**
     * @var string[]
     */
    private array $arguments;

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
        $content = $this->cacheGet(static::class);

        if ($content) {
            return $content;
        }

        $result = implode(PHP_EOL, $this->runCommand());

        $this->cacheSet(static::class, $result);

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
