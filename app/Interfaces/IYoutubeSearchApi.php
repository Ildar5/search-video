<?php

namespace App\Interfaces;

interface IYoutubeSearchApi
{
    public function search($q): array;
}