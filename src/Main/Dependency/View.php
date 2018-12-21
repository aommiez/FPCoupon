<?php
namespace Main\Dependency;

use Main\Dependency\AbstractDependency;
use Slim\Container;

class View extends AbstractDependency
{
  public function __invoke(Container $container)
  {
    // new instance twig-view
    $view = new \Slim\Views\Twig($container["config"]["twig"]["templates"], [
      // 'cache'=> $container["config"]["twig"]["cache"]
    ]);

    /**
    * Global Session
    */
    $view->getEnvironment()->addGlobal('auth', $container->auth);

    $session = $container["session"];
    $adminSegment = $session->getSegment("admin");
    $userSegment = $session->getSegment("user");
    $view->getEnvironment()->addGlobal('admin', $adminSegment);
    $view->getEnvironment()->addGlobal('user', $userSegment);

    $view->addExtension(new \Slim\Views\TwigExtension(
    $container["router"],
    $container["request"]->getUri()
  ));
  $view->addExtension(new \Twig_Extension_Debug());
  return $view;
}
}
