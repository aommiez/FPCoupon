<?php

namespace Main;

use Slim\App;
use Interop\Container\ContainerInterface;
use Propel\Runtime\Propel;
use Main\Dependency;

class Main
{
    private $slim, $route, $configFolder;

    public function __construct($configFolder)
    {
        $this->configFolder = $configFolder;
    }

    public function run()
    {
        global $slim;
        $this->slim = $slim = new App(include($this->configFolder . '/slim.php'));
        $this->injectDependency();
        $this->route = new Route($this->slim);
        $this->route->run();
        $this->slim->run();
    }

    public function injectDependency()
    {
        $container = $this->slim->getContainer();
        $container["config_folder"] = $this->configFolder;
        $container["config"] = function (ContainerInterface $container) {
            $files = scandir($container["config_folder"], SCANDIR_SORT_NONE);
            $configs = [];
            foreach ($files as $item) {
                $path = $container["config_folder"] . "/" . $item;
                if (is_file($path)) {
                    $name = basename($path, ".php");
                    $configs[$name] = include($path);
                }
            }
            return $configs;
        };

        $dependency = new Dependency($this->slim);
        $dependency->run();
    }

    public function addMiddleware()
    {
        // $this->slim->add(new AuthMiddleware());
    }
}
