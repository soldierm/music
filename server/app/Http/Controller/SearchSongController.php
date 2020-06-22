<?php

namespace App\Http\Controller;

use App\Base\Controller;
use App\Http\App;
use App\Source\Music163;

class SearchSongController extends Controller
{
    /**
     * 根据歌曲名搜索歌曲
     *
     * @return mixed
     */
    public function __invoke()
    {
        $body = json_decode($this->request->getContent(), true);
        if (empty($body) || empty($body['song'])) {
            return [];
        }

        return (new Music163())->searchSong($body['song']);
    }
}
