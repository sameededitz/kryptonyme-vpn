<?php

namespace App\Services;

use GuzzleHttp\Client;

class OneSignalService
{
    protected $appId;
    protected $apiKey;
    protected $client;

    public function __construct()
    {
        $this->appId = config('services.onesignal.app_id');
        $this->apiKey = config('services.onesignal.api_key');

        $this->client = new Client();
    }

    public function sendPush($title, $message)
    {
        $url = 'https://api.onesignal.com/notifications?c=push';

        $headers = [
            'Authorization' => 'Key ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $payload = [
            'app_id' => $this->appId,
            'headings' => ['en' => $title],
            'contents' => ['en' => $message],
            "target_channel" => "push",
            "included_segments" => ['Active Subscriptions'],
        ];

        try {
            $response = $this->client->post($url, [
                'headers' => $headers,
                'json' => $payload,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
