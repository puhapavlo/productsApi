<?php

use Pablo\ApiProduct\exceptions\NotAuthorizedHttpException;
use Pablo\ApiProduct\middlewares\Authenticate;
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
    Router::post('/auth/sign-in', 'AuthController@signin');
    Router::get('/product', 'ProductController@index');
    Router::post('/user/add', 'AuthController@createUser');
});

Router::group([
    'middleware' => [
        Authenticate::class
    ]
], function () {
    // authenticated routes
    Router::post('/product/create', 'ProductController@create');
    Router::post('/product/update/{id}', 'ProductController@update')
        ->where(['id' => '[\d]+']);
});

Router::error(function(Request $request, Exception $exception) {
    $response = Router::response();
    switch (get_class($exception)) {
        case NotAuthorizedHttpException::class: {
            $response->httpCode(401);
            break;
        }
        case Exception::class: {
            $response->httpCode(500);
            break;
        }
    }
});
