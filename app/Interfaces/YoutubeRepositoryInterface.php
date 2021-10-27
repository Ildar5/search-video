<?php

namespace App\Interfaces;

interface YoutubeRepositoryInterface
{
    public function getListWithHtml($q): array;
}