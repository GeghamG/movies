<?php
return [
    'api_key' => env('OMDBAPI_KEY', '720c3666'),
    'base_url' => 'http://www.omdbapi.com/',
    'request_urls' => [
        'first' => 's=Matrix',
        'second' => 's=Matrix%20Reloaded',
        'thirst' => 's=Matrix%20Revolutions',
    ]
];