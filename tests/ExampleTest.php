<?php

use Uchup07\LaravelZoom\Facades\LaravelZoom;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('can create meeting', function () {
    // $zoom = new LaravelZoom();

    $data = [
        'topic' => 'Title Topic 3',
        'default_password' => false,
        'start_time' => '2024-11-03T08:06:01Z',
        'duration' => 60,
        'timezone' => 'Asia/Jakarta',
        'type' => 2,
        'settings' => [
            'host_video' => true,
            'participant_video' => true,
            'audio' => true,
            'approval_type' => 2,
            'waiting_room' => true,
            'join_before_host' => true,
        ],
    ];

    $meeting = LaravelZoom::createMeeting('gatot.sulistiyo@erajaya.com', $data);

    expect($meeting)->toMatchSnapshot();
});

it('can remove meeting', function () {
    // $zoom = new LaravelZoom();

    $meeting = LaravelZoom::deleteMeeting('95952338096');

    expect($meeting)->toMatchArray([
        'status' => true,
        'message' => 'Meeting Deleted Successfully',
    ]);
});
