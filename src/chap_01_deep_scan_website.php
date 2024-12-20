<?php

const DEFAULT_URL = 'unlikelysource.com';
const DEFAULT_TAG = 'img';

require __DIR__ .'/Application/Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__);

$deep = new \Application\Web\Deep();

$url = strip_tags($_GET['URL'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['TAG'] ?? DEFAULT_TAG);

foreach ($deep->scan($url, $tag) as $item) {
    $src = $item['attributes']['src'] ?? '';
    if ($src && (stripos($src, 'png') || stripos($src, 'jpg'))) {
        printf('<br><img src="%s" />', $src);
    }
}