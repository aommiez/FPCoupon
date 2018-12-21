<?php
session_start();
$bootstrap = [
  "config_folder"=> "config",
  "autoload"=> "vendor/autoload.php"
];
date_default_timezone_set("Asia/Bangkok");
require($bootstrap["autoload"]);
$app = new \Main\Main($bootstrap["config_folder"]);
$app->run();
