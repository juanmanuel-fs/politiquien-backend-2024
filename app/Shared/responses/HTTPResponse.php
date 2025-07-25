<?php

namespace App\Shared\responses;


use App\Enums\HttpStatus;
use \Illuminate\Http\JsonResponse as JsonResponse;


class HTTPResponse
{

    private array $headers;

    public function __construct(){
        $this->headers = array (
            'Content-Type'  => 'application/vnd.api+json',
            'Accept'        => 'application/vnd.api+json'
        );
    }

    public function ok(array $res): JsonResponse
    {
        return response()->json(
            $res, HttpStatus::OK->value
        )->withHeaders($this->headers);
    }

    public function created(array $res): JsonResponse
    {
        return response()->json(
            $res,HttpStatus::CREATED->value
        )->withHeaders($this->headers);
    }

    public function accepted(array $res): JsonResponse
    {
        return response()->json([], HttpStatus::ACCEPTED->value
        )->withHeaders($this->headers);
    }

    public function noContent(array $res): JsonResponse
    {
        return response()->json($res, HttpStatus::NO_CONTENT->value
        )->withHeaders($this->headers);
    }

    public function badRequest(array $res): JsonResponse
    {
        return response()->json([$res],HttpStatus::BAD_REQUEST->value);
    }

    public function unauthorized($res, $data): JsonResponse
    {
        return response()->json($res,HttpStatus::UNAUTHORIZED->value);
    }

    public function forbidden($res, $data): JsonResponse
    {
        return response()->json($res,HttpStatus::FORBIDDEN->value);
    }

    public function noFound($res, $data): JsonResponse
    {
        return response()->json([],HttpStatus::NOT_FOUND->value);
    }

    public function internalServerError($res, $data): JsonResponse
    {
        return response()->json([],HttpStatus::INTERNAL_SEVER_ERROR->value);
    }
}
