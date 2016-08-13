<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PlexRequest extends Model
{
    protected $table = 'requests';

    public function getPosterPath($imdbid = null, $type)
    {
        if ($imdbid == null) {
            return false;
        } else {
            if ($type == 'movie') {
                $poster_path = '/storage/posters/movie/' . $imdbid . '.jpg';
                return $poster_path;
            } elseif ($type == 'tv') {
                $poster_path = '/storage/posters/tv/' . $imdbid . '.jpg';
                return $poster_path;
            }
        }
    }
}
