<?php

namespace Pablo\ApiProduct\MessageServices;

use Pablo\ApiProduct\Helper\Helper;
use Pablo\ApiProduct\MessageServices\Enum\EntityEvents;
use Pablo\ApiProduct\MessageServices\Enum\HttpCodes;
use Pablo\ApiProduct\MessageServices\exceptions\EntityEventDoesNotExist;
use Pecee\Http\Response;

/**
 * MessageResponseService for Entity.
 */
class EntityMessageResponseService extends MessageResponseService
{
    /**
     * @throws EntityEventDoesNotExist
     */
    public static function sendMessage(
        Response $recipient,
        string $message = '',
        string $placeholder = '',
        EntityEvents $entity_event = null
    ) {
        if ($entity_event) {
            try {
                $message = Helper::placeholder($entity_event->messagePlaceholder(), [
                    '@name' => $placeholder,
                ]);
                self::sendHttpCode($recipient, $entity_event->httpCode());
            } catch (EntityEventDoesNotExist) {
                throw new EntityEventDoesNotExist($entity_event);
            }
        }
        parent::sendMessage($recipient, $message);
    }
}
