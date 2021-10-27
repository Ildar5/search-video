<?php

namespace App\Domain\Services;
use App\Interfaces\YoutubeConnectInterface;
use Google_Service_YouTube;
use Google_Client;

class YoutubeConnect implements YoutubeConnectInterface
{
    public $youtubeApi;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setDeveloperKey(config("services.youtube.api_key"));
        $this->youtubeApi = new Google_Service_YouTube($client);
    }

    public function getYoutubeApi(): Google_Service_YouTube
    {
        return $this->youtubeApi;
    }
}