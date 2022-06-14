<?php

declare(strict_types=1);

namespace NtpSrv\classes\commands;

use Exception;
use NtpSrv\classes\dto\IntermediateGpsPipeMessage;
use NtpSrv\classes\dto\PpsGpsPipeMessage;
use NtpSrv\classes\dto\TpvGpsPipeMessage;
use NtpSrv\interfaces\OutputCacheInterface;
use NtpSrv\interfaces\GpsPipeMessageInterface;

final class GpsPipe extends AbstractCommand
{
    private const MESSAGE_CLASS_MAP = [
        GpsPipeMessageInterface::MESSAGE_TYPE_PPS => PpsGpsPipeMessage::class,
        GpsPipeMessageInterface::MESSAGE_TYPE_TPV => TpvGpsPipeMessage::class,
    ];

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct(
            'gpspipe',
            [
                '--json',
                '--pps',
                '--seconds 3'
            ]
        );

        $this->setCacheTime(OutputCacheInterface::CACHE_TIME_30_SECONDS);
    }

    /**
     * {@inheritDoc}
     */
    public function getOutput(): string
    {
        $rawOutput = parent::getOutput();

        try {
            return $this->parseOutput($rawOutput);
        } catch (Exception) {
            return 'Failed to fetch GPS data.';
        }
    }

    /**
     * @param string $rawOutput
     *
     * @return string
     *
     * @throws Exception
     */
    private function parseOutput(string $rawOutput): string
    {
        $jsonMessages = explode(PHP_EOL, $rawOutput);
        // Reverse the array to get the newest messages first.
        $jsonMessages = array_reverse($jsonMessages);
        $output = [];

        foreach ($jsonMessages as $jsonMessage) {
            $messageArray = json_decode($jsonMessage, true, 10, JSON_THROW_ON_ERROR);
            $intermediateMessage = new IntermediateGpsPipeMessage($messageArray);

            if (
                array_key_exists($intermediateMessage->getClass(), self::MESSAGE_CLASS_MAP)
                && empty($output[$intermediateMessage->getClass()])
            ) {
                $className = self::MESSAGE_CLASS_MAP[$intermediateMessage->getClass()];
                /** @var GpsPipeMessageInterface $message */
                $message = new $className($messageArray);
                $output[$message->getClass()] = $message->getDisplayString();
            }
        }

        if (
            empty($output[GpsPipeMessageInterface::MESSAGE_TYPE_PPS])
            || empty($output[GpsPipeMessageInterface::MESSAGE_TYPE_TPV])
        ) {
            return 'GPS not locked, no messages.';
        }

        return implode(PHP_EOL, $output);
    }
}
