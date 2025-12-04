<?php

namespace Uchup07\LaravelZoom;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class LaravelZoom
{
    protected string $access_token;

    protected string $account_id;

    protected string $client_id;

    protected string $client_secret;

    protected string $api_url;

    protected string $credentials;

    protected $client;

    public function __construct()
    {
        $this->account_id = config('zoom.account_id');
        //        $this->client_id = config('zoom.client_id');
        //        $this->client_secret = config('zoom.client_secret');
        $this->credentials = config('zoom.credentials');
        $this->api_url = config('zoom.api_url');

        $this->access_token = $this->getAccessToken();

        $this->client = new Client([
            'base_uri' => $this->api_url,
            'headers' => [
                'Authorization' => 'Bearer '.$this->access_token,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Get an access token
     *
     * @return mixed
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getAccessToken()
    {
        $client = new Client([
            'headers' => [
                //                'Authorization' => 'Basic ' . base64_encode("$this->client_id:$this->client_secret"),
                'Authorization' => 'Basic '.$this->credentials,
                'Host' => 'zoom.us',
            ],
        ]);

        $response = $client->request('POST', 'https://zoom.us/oauth/token', [
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => $this->account_id,
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return $responseBody['access_token'];
    }

    /**
     * Create a Meeting
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createMeeting(string $userId, array $params)
    {
        try {
            $response = $this->client->request('POST', 'users/'.$userId.'/meetings', [
                'json' => $params,
            ]);

            $res = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $res,
            ];

        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Update a Meeting
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateMeeting(string $meetingId, array $params)
    {
        try {
            $response = $this->client->request('PATCH', 'meetings/'.$meetingId, [
                'json' => $params,
            ]);
            if ($response->getStatusCode() === 204) {
                return [
                    'status' => true,
                    'message' => 'Meeting Update Successfully',
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Something went wrong',
                ];
            }
        } catch (ClientException $th) {
            return [
                'status' => false,
                'code' => $th->getCode(),
                'message' => $th->getMessage(),
            ];
        }
    }

    /**
     * Get a Meeting
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMeeting(string $meetingId)
    {
        try {
            $response = $this->client->request('GET', 'meetings/'.$meetingId);

            $res = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $res,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * List Meetings by User
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listMeetings(string $userId)
    {
        try {
            $response = $this->client->request('GET', 'users/'.$userId.'/meetings');
            $data = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Delete or Remove Meeting
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteMeeting(string $meetingId)
    {
        try {
            $response = $this->client->request('DELETE', 'meetings/'.$meetingId);
            if ($response->getStatusCode() === 204) {
                return [
                    'status' => true,
                    'message' => 'Meeting Deleted Successfully',
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Something went wrong',
                ];
            }
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }

    }

    /**
     * List Upcoming Meetings
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listUpcomingMeetings(string $userId)
    {
        try {
            $response = $this->client->request('GET', 'users/'.$userId.'/upcoming_meetings');

            $data = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get Previous Meeting
     *
     * @return array
     */
    public function getPreviousMeetings(string $userId)
    {
        try {
            $meetings = $this->listMeetings($userId);

            $previousMeetings = [];

            foreach ($meetings['meetings'] as $meeting) {
                $start_time = strtotime($meeting['start_time']);

                if ($start_time < time()) {
                    $previousMeetings[] = $meeting;
                }
            }

            return [
                'status' => true,
                'data' => $previousMeetings];

        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Reschedule Meeting
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function rescheduleMeeting(string $meetingId, array $params)
    {
        try {
            $response = $this->client->request('PATCH', 'meetings/'.$meetingId, [
                'json' => $params,
            ]);
            if ($response->getStatusCode() === 204) {
                return [
                    'status' => true,
                    'message' => 'Meeting Rescheduled Successfully',
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Something went wrong',
                ];
            }
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Update Meeting Status to end
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function endMeeting($meetingId)
    {
        try {
            $response = $this->client->request('PUT', 'meetings/'.$meetingId.'/status', [
                'json' => [
                    'action' => 'end',
                ],
            ]);
            if ($response->getStatusCode() === 204) {
                return [
                    'status' => true,
                    'message' => 'Meeting Ended Successfully',
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Something went wrong',
                ];
            }
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Meeting Record Lists
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function meetingRecordLists($meetingId)
    {
        try {
            $response = $this->client->request('GET', 'meetings/'.$meetingId.'/recordings');
            $data = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get Meeting Recording Settings
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMeetingRecordingSettings($meetingId)
    {
        try {
            $response = $this->client->request('GET', 'meetings/'.$meetingId.'/recordings/settings');
            $data = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Meeting Record Lists By User
     * Must have a Pro or a higher plan. Must enable Cloud Recording on the user's account
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function meetingRecordListsByUser(string $userId)
    {
        try {
            $response = $this->client->request('GET', 'users/'.$userId.'/recordings');
            $data = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get past meeting participants
     * Must Paid account on a Pro or higher plan
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pastMeetingParticipants($meetingId, $page_size = 30)
    {
        try {
            $response = $this->client->request('GET', 'past_meetings/'.$meetingId.'/participants?page_size='.$page_size);
            $data = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Report Past Meeting Participants
     * Must Paid account on a Pro or higher plan
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reportPastMeetingParticipants($meetingId, $page_size = 30)
    {
        try {
            $response = $this->client->request('GET', 'report/meetings/'.$meetingId.'/participants?page_size='.$page_size);
            $data = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get Meeting Summary
     * @param $meetingId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMeetingSummary($meetingId)
    {
        try {
            $response = $this->client->request('GET', 'meetings/'.$meetingId.'/meeting_summary');
            $data = json_decode($response->getBody(), true);

            return [
                'status' => true,
                'data' => $data,
            ];
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Report Meeting
     * @param $meetingId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reportMeetings($meetingId)
    {
        try {
            $response = $this->client->request('GET', 'report/meetings/'.$meetingId);
            $data = json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
        return [
            'status' => true,
            'data' => $data,
        ];
    }

    /**
     * Report Meeting Participants
     * @param $meetingId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reportMeetingParticipants($meetingId)
    {
        try {
            $response = $this->client->request('GET', 'report/meetings/'.$meetingId.'/participants');
            $data = json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
        return [
            'status' => true,
            'data' => $data,
        ];
    }

    /**
     * Report Meeting Summary
     * @param $meetingId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reportMeetingSummary($meetingId)
    {
        try {
            $response = $this->client->request('GET', 'report/meetings/'.$meetingId.'/summary');
            $data = json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }

        return [
            'status' => true,
            'data' => $data,
        ];
    }
}
