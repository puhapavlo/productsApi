<?php

namespace Pablo\ApiProduct\MessageServices\Enum;

/**
 * Entity Events.
 */
enum EntityEvents
{
    case LOGIN_FAILED;
    case LOGIN_SUCCESS;
    case UPDATE_SUCCESS;
    case UPDATE_FAILED;
    case CREATE_SUCCESS;
    case CREATE_FAILED;
    case DELETE_SUCCESS;
    case DELETE_FAILED;

    public function messagePlaceholder(): string
    {
        return match ($this) {
            EntityEvents::LOGIN_FAILED => 'Login @name failed. 
            Please check the correctness of entering the username and password.',
            EntityEvents::LOGIN_SUCCESS => 'Login @name successfully',
            EntityEvents::UPDATE_SUCCESS => 'Update @name successfully',
            EntityEvents::UPDATE_FAILED => 'Update @name failed',
            EntityEvents::CREATE_SUCCESS => 'Create @name successfully',
            EntityEvents::CREATE_FAILED => 'Create @name failed',
            EntityEvents::DELETE_SUCCESS => 'Delete @name successfully',
            EntityEvents::DELETE_FAILED => 'Delete @name failed'
        };
    }

    public function httpCode(): HttpCodes
    {
        return match ($this) {
            EntityEvents::LOGIN_SUCCESS, EntityEvents::UPDATE_SUCCESS,
            EntityEvents::CREATE_SUCCESS,  EntityEvents::DELETE_SUCCESS  => HttpCodes::OK,
            EntityEvents::LOGIN_FAILED, EntityEvents::UPDATE_FAILED,
            EntityEvents::CREATE_FAILED, EntityEvents::DELETE_FAILED => HttpCodes::INTERNAL_SERVER_ERROR
        };
    }
}
