<?php

namespace Main;

use Slim\App;
use Slim\Container;
use Main\Dependency\Session;
use Main\Dependency\Xcrud;
use Main\Dependency\View;
use Main\Auth\Storage\RedisStorage;
use Main\Auth\Storage\SessionStorage;
use Interop\Container\ContainerInterface;
use Aura\Session\SessionFactory;

class Dependency
{
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function run()
    {
        $container = $this->app->getContainer();
        $container["view"] = new View();
        $container["auth"] = function (ContainerInterface $ci) {
            $storage = new SessionStorage();
            $auth = new \Main\Auth\Auth($ci, $storage);
            return $auth;
        };

        $container["xcrud"] = new Xcrud();
        $container["session"] = function (ContainerInterface $ci) {
            $session_factory = new SessionFactory();
            return $session_factory->newInstance($_COOKIE);
        };
        $container["medoo"] = function (ContainerInterface $container) {
            return new \Medoo\Medoo($container["config"]["medoo"]);
        };
        $container['notFoundHandler'] = function ($container) {
            return function ($request, $response) use ($container) {
                return $response->withStatus(404)
                    ->withHeader('Content-Type', 'text/html')
                    ->write('WHO AM I ? , ARE YOU HACKER ?');
            };
        };

        $container['notAllowedHandler'] = function ($c) {
            return function ($request, $response, $methods) use ($c) {
                return $response->withStatus(405)
                    ->withHeader('Allow', implode(', ', $methods))
                    ->withHeader('Content-type', 'text/html')
                    ->write('Method must be one of: ' . implode(', ', $methods) . '  ARE YOU HACKER ?');
            };
        };
    }
}
