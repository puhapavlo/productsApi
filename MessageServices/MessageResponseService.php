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
    public static function sendMessage(Response $recipient, string $message)
    {
        $recipient->json(['message' => $message]);
    }

    public static function sendHttpCode(Response $response, HttpCodes $code)
    {
        $response->httpCode($code->value);
    }
}
