<?php

use App\Http\Controller;

return [
    'route' => function (FastRoute\RouteCollector $r) {
        $r->get('/', new Controller\IndexController());
        $r->post('/search-song', new Controller\SearchSongController());
    }
];
