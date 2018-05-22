<?php

//require_once __DIR__.'/../Autoload/Loader_two.php';

//require __DIR__ . '/../Autoload/Loader.php';
// add current directory to the path
//\App\Autoload\Loader::init(__DIR__ . '/..');


// get "test" class
$test = new App\Test\TestClass();
echo $test->getTest();
