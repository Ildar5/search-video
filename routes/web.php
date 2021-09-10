<?php

use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/search');
Route::get('/search', 'App\Http\Controllers\SearchController@index');
Route::get('/get-video-list', 'App\Http\Controllers\SearchController@getYoutubeVideoList');
Route::get('/watch-video', 'App\Http\Controllers\SearchController@watchVideo');