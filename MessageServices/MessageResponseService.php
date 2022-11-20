<?php

namespace Pablo\ApiProduct\MessageServices;

use Pablo\ApiProduct\Helper\Helper;
use Pablo\ApiProduct\MessageServices\Enum\HttpCodes;
use Pecee\Http\Response;

/**
 * Service for send response messages.
 */
class MessageResponseService implements MessageServiceInterface
{
    public static function sendMessage(Response $recipient, $message)
    {
        $recipient->json(['message' => $message]);
    }

    public static function sendHttpCode(Response $recipient, HttpCodes $code)
    {
        $recipient->httpCode($code->value);
    }

    public static function sendForbidden(Response $recipient)
    {
        self::sendHttpCode($recipient, HttpCodes::FORBIDEN);
    }

    public static function sendInternalServerError(Response $recipient)
    {
        self::sendHttpCode($recipient, HttpCodes::INTERNAL_SERVER_ERROR);
    }
}
