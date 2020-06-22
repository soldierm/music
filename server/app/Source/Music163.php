<?php

namespace App\Source;

use App\Source\Exception\ApiResponseException;
use Throwable;

class Music163 implements Source
{
    /**
     * 网易云音乐接口相关数据
     *
     * @var string
     */
    const SOURCE_URL = 'https://api.imjad.cn/cloudmusic/';
    const SEARCH_SONG_PATH = '?type=search&search_type=1&s=';
    const DOWNLOAD_SONG_PATH = '?type=song&id=';

    /**
     * {@inheritDoc}
     */
    public function searchSong($song)
    {
        $url = self::SOURCE_URL . self::SEARCH_SONG_PATH . $song;

        try {
            $response = guzzle_client()->get($url);
            $body = json_decode($response->getBody()->getContents(), true);
            /* 判断接口数据是否正确返回 */
            if (200 !== $body['code']) {
                throw new ApiResponseException(sprintf('Request err: %d', $body['code']), 401);
        }
        return $this->parseBody($body);
    } catch (Throwable $exception) {
            return [];
        }
    }

    /**
     * 解析接口返回数据
     *
     * @param array $body
     * @return array
     */
    private function parseBody($body)
    {
        return array_map(function ($song) {
            return [
                'name' => $song['name'],
                'singer' => reset($song['ar'])['name'],
                'picture' => $song['al']['picUrl'],
                'url' => self::SOURCE_URL . self::DOWNLOAD_SONG_PATH . $song['id'],
            ];
        }, $body['result']['songs']);
    }
}