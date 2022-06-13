<?php

declare(strict_types=1);

namespace NtpSrv\classes\controller;

use NtpSrv\interfaces\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @var string
     */
    private string $contentType;

    /**
     * @var int
     */
    private int $responseCode;

    /**
     * @param string $contentType
     */
    public function __construct(string $contentType = self::CONTENT_TYPE_HTML)
    {
        $this->contentType = $contentType;
        $this->responseCode = self::RESPONSE_CODE_OK;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    /**
     * @param int $responseCode
     *
     * @return void
     */
    public function setResponseCode(int $responseCode): void
    {
        $this->responseCode = $responseCode;
    }

    /**
     * {@inheritDoc}
     */
    abstract public function getRoute(): string;

    /**
     * {@inheritDoc}
     */
    abstract public function get(): string;
}
