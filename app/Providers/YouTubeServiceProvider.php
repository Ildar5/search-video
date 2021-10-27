<?php

namespace App\Providers;

use App\Domain\Services\YoutubeConnect;
use App\Repository\YoutubeRepository;
use App\Http\Controllers\SearchController;
use Illuminate\Support\ServiceProvider;

class YouTubeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SearchController::class, function()
        {
            $youtubeConnect = new YoutubeConnect();
            return new SearchController(new YoutubeRepository($youtubeConnect->youtubeApi));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
