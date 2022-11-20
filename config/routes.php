<?php

use Pablo\ApiProduct\exceptions\NotAuthorizedHttpException;
use Pablo\ApiProduct\MessageServices\Enum\HttpCodes;
use Pablo\ApiProduct\MessageServices\MessageResponseService;
use Pablo\ApiProduct\middlewares\Authenticate;
use Pablo\ApiProduct\middlewares\ProcessArrayBody;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pablo\ApiProduct\middlewares\ProcessRawBody;
use Pablo\ApiProduct;

Router::setDefaultNamespace('Pablo\ApiProduct\Controllers');

Router::group([
    'prefix' => 'api/v1',
    'middleware' => [
        ProcessRawBody::class
    ]
], function () {
    Router::post('/auth/sign-in', 'AuthController@login');
});

// Router group for authenticated routes.
Router::group([
    'prefix' => 'api/v1',
    'middleware' => [
        Authenticate::class,
        ProcessRawBody::class
    ]
], function () {
    Router::get('/{entity_type}', 'EntityController@viewAllEntity');
    Router::get('/term/{bundle_type}', 'EntityController@viewAllEntity');
    Router::get('/term/{bundle_type}/{id}', 'EntityController@viewEntity');
    Router::get('/{entity_type}/{id}', 'EntityController@viewEntity');

    Router::delete('/{entity_type}/delete/{id}', 'EntityController@deleteEntity');
    Router::delete('/term/{bundle_type}/delete/{id}', 'EntityController@deleteEntity');
});

Router::group([
    'prefix' => 'api/v1',
    'middleware' => [
        Authenticate::class,
        ProcessArrayBody::class
    ]
], function () {
    Router::post('/{entity_type}/update/{id}', 'EntityController@updateEntity');
    Router::post('/{entity_type}/add', 'EntityController@addEntity');
    Router::post('/term/{bundle_type}/update/{id}', 'EntityController@updateEntity');
    Router::post('/term/{bundle_type}/add', 'EntityController@addEntity');
});

Router::error(function(Request $request, Exception $exception)
{
    $response = Router::response();
    switch (get_class($exception)) {
        case NotAuthorizedHttpException::class:
            MessageResponseService::sendHttpCode($response,HttpCodes::UNAUTHORIZED);
            break;
        case Exception::class:
            MessageResponseService::sendInternalServerError($response);
            break;
    }
});
