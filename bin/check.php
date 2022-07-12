<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
//$k = new \Salarmotevalli\PhpChecker\Classes\Kernel($argc, $argv, $GLOBALS['_composer_bin_dir']);
//$k->run();

$filename = './read.txt';

$file = new \Salarmotevalli\PhpChecker\FileWorker\File($filename);
var_dump($file->isThere());
