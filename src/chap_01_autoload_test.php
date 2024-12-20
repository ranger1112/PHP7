<?php

require __DIR__ . '/Application/Autoload/Loader.php';

//echo 'DIR :'. __DIR__ . '/..' . PHP_EOL;

\Application\Autoload\Loader::init(__DIR__ );

$test = new Application\Test\TestClass();
echo $test->getTest() .PHP_EOL;
# Application\Test\TestClass::getTest

$fake = new Application\Fake\FakeClass();
echo $fake->getTest() .PHP_EOL;
# Fatal error: Uncaught Exception: Unable to load class Application\Fake\FakeClass in ...