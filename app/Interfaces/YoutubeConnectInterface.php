<?php

namespace App\Interfaces;
use Google_Service_YouTube;

interface YoutubeConnectInterface
{
    public function getYoutubeApi(): Google_Service_YouTube;
}