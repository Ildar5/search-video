<?php

namespace App\Interfaces;

interface IYoutubeSearchApi
{
    public function getListWithHtml($q): array;
}