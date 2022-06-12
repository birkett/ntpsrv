<?php

declare(strict_types=1);

namespace NtpSrv\classes\dto;

use NtpSrv\interfaces\GpsPipeMessageInterface;

abstract class AbstractGpsPipeMessage implements GpsPipeMessageInterface
{
    /**
     * @var string
     */
    protected string $class;

    /**
     * @var string
     */
    protected string $device;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function getDevice(): string
    {
        return $this->device;
    }

    /**
     * {@inheritDoc}
     */
    public function getDisplayString(): string
    {
        return sprintf('Message Type: %s Device: %s', $this->getClass(), $this->getDevice());
    }
}
