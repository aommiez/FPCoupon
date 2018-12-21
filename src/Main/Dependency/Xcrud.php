<?php

namespace Main\Dependency;

use Main\Xcrud\XcrudFactory;
use Slim\Container;

class Xcrud extends AbstractDependency
{
    public function __invoke(Container $ci)
    {
        \Xcrud_config::$scripts_url = $ci->request->getUri()->getBaseUrl();
        \Xcrud_config::$editor_url = implode('/', [trim($ci->request->getUri()->getBaseUrl()), trim(\Xcrud_config::$editor_url, '/')]);
        \Xcrud_config::$dbname = $ci->config['xcrud']['dbname'];
        \Xcrud_config::$dbuser = $ci->config['xcrud']['dbuser'];
        \Xcrud_config::$dbpass = $ci->config['xcrud']['dbpass'];
        \Xcrud_config::$dbhost = $ci->config['xcrud']['dbhost'];
        \Xcrud_config::$dbencoding = $ci->config['xcrud']['dbencoding'];
        \Xcrud_config::$db_time_zone = $ci->config['xcrud']['db_time_zone'];
        \Xcrud_config::$mbencoding = $ci->config['xcrud']['mbencoding'];

        return new XcrudFactory();
    }
}
