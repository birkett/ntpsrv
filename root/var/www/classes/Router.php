<?php

declare(strict_types=1);

namespace NtpSrv\classes;

use NtpSrv\classes\controller\NotFoundController;
use NtpSrv\interfaces\ControllerInterface;

final class Router
{
    private const METHOD_GET = 'GET';

    /**
     * @var ControllerInterface[]
     */
    private array $controllers;

    /**
     * @param string[] $controllers
     */
    public function __construct(array $controllers)
    {
        foreach ($controllers as $controller) {
            $this->controllers[] = new $controller();
        }
    }

    /**
     * @param string $method
     * @param string $path
     *
     * @return string
     */
    public function handleRequest(string $method, string $path): string
    {
        $matchedController = null;

        foreach ($this->controllers as $controller) {
            if ($controller->getRoute() === $path) {
                $matchedController = $controller;

                break;
            }
        }

        if ($method !== self::METHOD_GET) {
            $matchedController = null;
        }

        if (!$matchedController instanceof ControllerInterface) {
            $matchedController = new NotFoundController();
        }

        $content = $matchedController->get();

        $this->setResponseCode($matchedController->getResponseCode());
        $this->setContentType($matchedController->getContentType());

        return $content;
    }

    /**
     * @param int $responseCode
     *
     * @return void
     */
    private function setResponseCode(int $responseCode): void
    {
        http_response_code($responseCode);
    }

    /**
     * @param string $contentType
     *
     * @return void
     */
    private function setContentType(string $contentType): void
    {
        header('Content-Type: ' . $contentType);
    }
}
