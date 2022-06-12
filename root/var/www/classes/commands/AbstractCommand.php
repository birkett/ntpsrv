<?php

declare(strict_types=1);

namespace NtpSrv\classes\commands;

use NtpSrv\interfaces\ConsoleCommand;

abstract class AbstractCommand implements ConsoleCommand
{
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
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return implode(PHP_EOL, $this->runCommand());
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
