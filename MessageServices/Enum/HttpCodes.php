<?php

namespace Pablo\ApiProduct\MessageServices\Enum;

/**
 * Response HTTP codes.
 */
enum HttpCodes: int
{
    case FORBIDEN = 403;
    case NOT_FOUND = 404;
    case OK = 200;
    case UNAUTHORIZED = 401;
    case INTERNAL_SERVER_ERROR = 500;
    case BAD_GATEWAY = 502;
}
