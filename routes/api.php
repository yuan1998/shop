<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version( 'v1', [
    'namespace' => "App\Http\Controllers\Api",
    'middleware' => ["serializer:array",'bindings'],
], function($api) {

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ],function ($api) {

        /**
         *  登录才能调用的接口.
         */
        $api->group([
            'middleware' => 'api.auth'
        ],function ($api) {


        });


    });


    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {

        //发送短信验证码
        $api->post('sms','VerificationController@store')
            ->name('api.sms.store');



        /**
         *  登录才能调用的接口.
         */
        $api->group([
            'middleware' => 'api.auth'
        ],function ($api) {

            // check is Log
            $api->get('user','UserController@me')
                ->name('api.user.me');

            $api->patch('user','UserController@update')
                ->name('api.user.me');

            //  刷新 Token
            $api->put('auth/current','AuthController@update')
                ->name('api.auth.update');

            // 删除Token
            $api->delete('auth/current','AuthController@destroy')
                ->name('api.auth.destroy');

        });




    });



});
