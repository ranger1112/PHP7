<?php

const DEFAULT_URL = 'http://oreilly.com/';
const DEFAULT_TAG = 'a';

require __DIR__ .'/Application/Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__);

$vac = new \Application\Web\Hoover();

//
$url = strip_tags($_GET['URL'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['TAG'] ?? DEFAULT_TAG);

echo 'Dump of Tags:' . PHP_EOL;
var_dump($vac->getTags($url, $tag));


