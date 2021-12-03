<?php

declare(strict_types=1);

namespace App\Repository;

use App\Interfaces\YoutubeRepositoryInterface;
use Illuminate\Support\Facades\View;
use Google_Service_YouTube;


class YoutubeRepository implements YoutubeRepositoryInterface
{
    private $maxResults;
    private $youtube;

    public function __construct(Google_Service_YouTube $youtube)
    {
        $this->maxResults = config("services.youtube.max_results");
        $this->youtube = $youtube;
    }

    private function search($q): array
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

    public function getListWithHtml($q): array
    {
        $html = "";
        $status = 0;
        $videoList = $this->search($q);

        if ($videoList) {
            $html = View::make('search.partials.video-list', [
                'result' => $videoList
            ])->render();

            $status = 1;
        }

        return [
            "status" => $status,
            "html" => $html
        ];
    }
}