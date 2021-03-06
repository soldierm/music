<?php

use App\Console\Command\HttpServerCommand;
use Doctrine\Common\Cache\PredisCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Predis\Client;
use Symfony\Component\Console\Application;
use Symfony\Component\HttpFoundation\Request;
use function FastRoute\simpleDispatcher;

return [
    'http_service' => function () {
        $this->container['request'] = $this->request = Request::createFromGlobals();
        $this->container['entityManager'] = EntityManager::create(config('mysql'), Setup::createAnnotationMetadataConfiguration([APP_PATH . '/Http/Entity'], true, null, null, false));
        $this->container['cache'] = new PredisCache(new Client(config('cache')['parameters'], config('cache')['options']));

        $this->container['guzzle'] = new \GuzzleHttp\Client(['verify' => false]);
    },
    'http_bootstrap' => function () {
        $this->routeDispatcher = simpleDispatcher($this->getConfig()->get('route'));
        $this->addMiddleware('echo');
    },
    'console_service' => function () {
    },
    'console_bootstrap' => function () {
    }
];
