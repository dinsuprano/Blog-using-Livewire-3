<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
        \App\Http\Middleware\YourGlobalMiddleware::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\YourWebMiddleware::class,
        ],

        'api' => [
            \App\Http\Middleware\YourApiMiddleware::class,
        ],
    ];

    protected $routeMiddleware = [
        'yourMiddleware' => \App\Http\Middleware\YourMiddlewareName::class,
    ];
}
