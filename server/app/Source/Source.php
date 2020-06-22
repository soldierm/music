<?php

namespace App\Source;

interface Source
{
    /**
     * 根据歌曲名搜索歌曲
     *
     * @param string $song
     * @return array
     */
    public function searchSong($song);
}