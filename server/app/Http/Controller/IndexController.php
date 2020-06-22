<?php

namespace App\Http\Controller;

use App\Base\Controller;
use App\Http\App;

class IndexController extends Controller
{
    /**
     * 首页控制器
     *
     * @return mixed
     */
    public function __invoke()
    {
        return [
            'title' => '音乐整合搜索接口',
            'version' => App::VERSION,
            'datetime' => date('Y-m-d H:i:s')
        ];
    }
}
