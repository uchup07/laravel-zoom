# This is my package laravel-zoom

[![Latest Version on Packagist](https://img.shields.io/packagist/v/uchup07/laravel-zoom.svg?style=flat-square)](https://packagist.org/packages/uchup07/laravel-zoom)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/uchup07/laravel-zoom/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/uchup07/laravel-zoom/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/uchup07/laravel-zoom/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/uchup07/laravel-zoom/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/uchup07/laravel-zoom.svg?style=flat-square)](https://packagist.org/packages/uchup07/laravel-zoom)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-zoom.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-zoom)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require uchup07/laravel-zoom
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-zoom-config"
```

This is the contents of the published config file:

```php
return [
    'client_id' => env('ZOOM_CLIENT_ID'),
    'client_secret' => env('ZOOM_CLIENT_SECRET'),
    'account_id' => env('ZOOM_CLIENT_ACCOUNT_ID'),
    'credentials' => env('ZOOM_CLIENT_CREDENTIALS'),
    'api_url' => env('ZOOM_CLIENT_API_URL','https://api.zoom.us/v2/'),
];
```

## Usage

### Create Meeting

```php
$data = [
            'topic' => 'Title Topic',
            'default_password'=>false,
            'start_time' => '2024-10-31T08:06:01Z',
            'duration' => 60,
            'timezone' => 'Asia/Jakarta',
            "type"=> 2,
            'settings' => [
                'host_video' => true,
                'participant_video' => true,
                'audio' => true,
                'approval_type' => 2,
                'waiting_room' => true,
                'join_before_host' => true
            ],
        ];

$meeting = \Uchup07\LaravelZoom\Facades\LaravelZoom::createMeeting('userid@mail.com', $data);


```

### Update Meeting
```php
$data = [
            'topic' => 'Title Topic',
            'default_password'=>false,
            'start_time' => '2024-10-31T08:06:01Z',
            'duration' => 60,
            'timezone' => 'Asia/Jakarta',
            "type"=> 2,
            'settings' => [
                'host_video' => true,
                'participant_video' => true,
                'audio' => true,
                'approval_type' => 2,
                'waiting_room' => true,
                'join_before_host' => true
            ],
        ];
        
$meeting = \Uchup07\LaravelZoom\Facades\LaravelZoom::updateMeeting(94064237172, $data);
```

### Delete Meeting
```php
$meetingId = 94064237172;
$meeting = \Uchup07\LaravelZoom\Facades\LaravelZoom::deleteMeeting($meetingId);
```

### Get a Meeting
```php
$meetingId = 94064237172;
$meeting = \Uchup07\LaravelZoom\Facades\LaravelZoom::getMeeting($meetingId);
```


## Testing

```bash
./vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Yusuf](https://github.com/uchup07)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
