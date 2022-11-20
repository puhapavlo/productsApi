<?php

namespace Pablo\ApiProduct\MessageServices;

use Pecee\Http\Response;

/**
 * Interface for Message services.
 */
interface MessageServiceInterface
{
    /**
     * Method for sending messages.
     *
     * @param Response $recipient
     *  Recipient of the message
     * @param string $message
     *  Message for send.
     *
     * @return mixed
     */
    public static function sendMessage(Response $recipient, string $message);
}
