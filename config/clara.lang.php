<?php

return [

    'route' => [
        'web' => [
            'prefix'    => 'admin',
            'middleware' => ['web', \CeddyG\ClaraSentinel\Http\Middleware\SentinelAccessMiddleware::class]
        ]
    ],
    
    'controller' => 'CeddyG\ClaraLanguage\Http\Controllers\Admin\LangController',
];