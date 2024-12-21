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

#### Default parameters for

```php
$arrayVar = [
    "agenda" => "<string>",
    "default_password" => false,
    "duration" => "<integer>",
    "password" => "<string>",
    "pre_schedule" => false,
    "recurrence" => [
        "type" => 2,
        "end_date_time" => "<dateTime>",
        "end_times" => 1,
        "monthly_day" => 1,
        "monthly_week" => 1,
        "monthly_week_day" => 6,
        "repeat_interval" => "<integer>",
        "weekly_days" => "1",
    ],
    "schedule_for" => "<string>",
    "settings" => [
        "additional_data_center_regions" => ["<string>", "<string>"],
        "allow_multiple_devices" => "<boolean>",
        "alternative_hosts" => "<string>",
        "alternative_hosts_email_notification" => true,
        "approval_type" => 2,
        "approved_or_denied_countries_or_regions" => [
            "approved_list" => ["<string>", "<string>"],
            "denied_list" => ["<string>", "<string>"],
            "enable" => "<boolean>",
            "method" => "deny",
        ],
        "audio" => "both",
        "audio_conference_info" => "<string>",
        "authentication_domains" => "<string>",
        "authentication_exception" => [
            ["email" => "<email>", "name" => "<string>"],
            ["email" => "<email>", "name" => "<string>"],
        ],
        "authentication_option" => "<string>",
        "auto_recording" => "none",
        "breakout_room" => [
            "enable" => "<boolean>",
            "rooms" => [
                [
                    "name" => "<string>",
                    "participants" => ["<string>", "<string>"],
                ],
                [
                    "name" => "<string>",
                    "participants" => ["<string>", "<string>"],
                ],
            ],
        ],
        "calendar_type" => 2,
        "close_registration" => false,
        "cn_meeting" => false,
        "contact_email" => "<string>",
        "contact_name" => "<string>",
        "email_notification" => true,
        "encryption_type" => "enhanced_encryption",
        "focus_mode" => "<boolean>",
        "global_dial_in_countries" => ["<string>", "<string>"],
        "host_video" => "<boolean>",
        "in_meeting" => false,
        "jbh_time" => 10,
        "join_before_host" => false,
        "language_interpretation" => [
            "enable" => "<boolean>",
            "interpreters" => [
                ["email" => "<email>", "languages" => "<string>"],
                ["email" => "<email>", "languages" => "<string>"],
            ],
        ],
        "sign_language_interpretation" => [
            "enable" => "<boolean>",
            "interpreters" => [
                ["email" => "<email>", "sign_language" => "<string>"],
                ["email" => "<email>", "sign_language" => "<string>"],
            ],
        ],
        "meeting_authentication" => "<boolean>",
        "meeting_invitees" => [["email" => "<email>"], ["email" => "<email>"]],
        "mute_upon_entry" => false,
        "participant_video" => "<boolean>",
        "private_meeting" => "<boolean>",
        "registrants_confirmation_email" => "<boolean>",
        "registrants_email_notification" => "<boolean>",
        "registration_type" => 1,
        "show_share_button" => "<boolean>",
        "use_pmi" => false,
        "waiting_room" => "<boolean>",
        "watermark" => false,
        "host_save_video_order" => "<boolean>",
        "alternative_host_update_polls" => "<boolean>",
        "internal_meeting" => false,
        "continuous_meeting_chat" => [
            "enable" => "<boolean>",
            "auto_add_invited_external_users" => "<boolean>",
        ],
        "participant_focused_meeting" => false,
        "push_change_to_calendar" => false,
        "resources" => [
            [
                "resource_type" => "whiteboard",
                "resource_id" => "<string>",
                "permission_level" => "editor",
            ],
            [
                "resource_type" => "whiteboard",
                "resource_id" => "<string>",
                "permission_level" => "editor",
            ],
        ],
        "auto_start_meeting_summary" => false,
        "auto_start_ai_companion_questions" => false,
    ],
    "start_time" => "<dateTime>",
    "template_id" => "<string>",
    "timezone" => "<string>",
    "topic" => "<string>",
    "tracking_fields" => [
        ["field" => "<string>", "value" => "<string>"],
        ["field" => "<string>", "value" => "<string>"],
    ],
    "type" => 2,
];
```

Example:
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

### Get All Meeting By User
```php
$userId = 'user@email.com';
$meetings = \Uchup07\LaravelZoom\Facades\LaravelZoom::listMeetings($userId);
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
