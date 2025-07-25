<?php

namespace App\Enums;
enum HttpStatus: int {
    case OK = 200;
    case CREATED = 201;
    case ACCEPTED = 202;
    case NO_CONTENT = 204;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case NOT_ACCEPTABLE = 406;
    case UNSUPPORTED_MEDIA_TYPE = 415;
    case INTERNAL_SEVER_ERROR = 500;
}
