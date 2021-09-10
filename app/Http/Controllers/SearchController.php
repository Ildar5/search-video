<?php

namespace App\Http\Controllers;

use App\Domain\Services\YoutubeSearchApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    private $youtubeApi;

    public function __construct()
    {
        $this->youtubeApi = new YoutubeSearchApi();
    }

    public function index()
    {
        $html = "";
        if (isset($_GET['q'])) {
            $videoList = $this->youtubeApi->search($_GET['q']);
            $html = $this->getListWithHtml($videoList)["html"];
        }

        return view('search.index', compact( 'html'));
    }

    public function getYoutubeVideoList(Request $request)
    {
        $videoList = $this->youtubeApi->search($request->q);
        $videoList = $this->getListWithHtml($videoList);

        return response()->json(
            [
                "result" => $videoList["html"],
                "status" => $videoList["status"],
            ], 200);
    }

    public function getListWithHtml($videoList): array
    {
        $html = "";
        $status = 0;

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

    public function watchVideo(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $description = $request->description;

        return view('search.watch-video', compact( 'id', 'title', 'description'));
    }
}
