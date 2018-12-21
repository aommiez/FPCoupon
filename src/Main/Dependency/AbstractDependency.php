<?php
namespace Main\Dependency;
use Slim\Container;

abstract class AbstractDependency
{
  abstract public function __invoke(Container $container);
}
