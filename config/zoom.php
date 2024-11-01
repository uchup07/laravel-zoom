<?php

// config for Uchup07/LaravelZoom
return [
    'client_id' => env('ZOOM_CLIENT_ID'),
    'client_secret' => env('ZOOM_CLIENT_SECRET'),
    'account_id' => env('ZOOM_CLIENT_ACCOUNT_ID'),
    'credentials' => env('ZOOM_CLIENT_CREDENTIALS'),
    'api_url' => env('ZOOM_CLIENT_API_URL', 'https://api.zoom.us/v2/'),
];
