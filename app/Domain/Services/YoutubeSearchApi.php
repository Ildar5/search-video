<?php

namespace App\Domain\Services;

use App\Interfaces\IYoutubeSearchApi;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\View;


class YoutubeSearchApi implements IYoutubeSearchApi
{
    private $maxResults;
    private $youtubeApiKey;
    private $client;
    private $youtube;

    public function __construct()
    {
        $this->maxResults = config("services.youtube.max_results");
        $this->youtubeApiKey = config("services.youtube.api_key");
        $this->client = new \Google_Client();
        $this->client->setDeveloperKey($this->youtubeApiKey);
        $this->youtube = new \Google_Service_YouTube($this->client);
    }

    public function search($q): array
    {
        try {
            $searchResponse = $this->youtube->search->listSearch('id,snippet', [
                'q' => $q,
                'maxResults' => $this->maxResults,
            ]);

            return $this->getList($searchResponse);

        } catch (\Google_Service_Exception $e) {
            logger($e->getMessage());
        } catch (\Google_Exception $e) {
            logger($e->getMessage());
        }
        return ['items' => []];
    }

    private function getList($searchResponse): array
    {
        $result = [];

        foreach ($searchResponse['items'] as $searchResult) {
            if ($searchResult['id']['kind'] == "youtube#video") {
                $result[$searchResult['id']['videoId']] = [
                    "title" => $searchResult['snippet']['title'],
                    "description" => $searchResult['snippet']['description'],
                ];
            }
        }
        return $result;
    }
}