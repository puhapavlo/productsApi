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
});

// Router group for authenticated routes.
Router::group([
    'prefix' => 'api/v1',
    'middleware' => [
        Authenticate::class,
        ProcessRawBody::class
    ]
], function () {
    Router::get('/users', 'UserController@getUsers');
    Router::post('/user/add', 'AuthController@register');
    Router::delete('/user/delete/{id}', 'UserController@deleteUser')
        ->where(['id' => '[\d]+']);
    Router::post('/user/update/{id}', 'UserController@updateUser')
        ->where(['id' => '[\d]+']);

    Router::get('/products', 'ProductController@index');
    Router::get('/product/{id}', 'ProductController@getProduct')
        ->where(['id' => '[\d]+']);
    Router::post('/product/add', 'ProductController@create');
    Router::post('/product/update/{id}', 'ProductController@update')
        ->where(['id' => '[\d]+']);
    Router::delete('/product/delete/{id}', 'ProductController@delete')
        ->where(['id' => '[\d]+']);

    Router::post('/term/status/add', 'StatusTermController@addTerm');
    Router::post('/term/category/add', 'CategoryTermController@addTerm');
    Router::get('/term/{type}/{id}', 'TermsController@getTerm')
        ->where(['id' => '[\d]+']);
    Router::delete('/term/delete/{type}/{id}', 'TermsController@deleteTerm')
        ->where(['id' => '[\d]+']);
    Router::get('/terms/{type}', 'TermsController@getTerms');
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
