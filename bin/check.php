<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/Classes/Kernel.php';

// $kernel = new Kernel($argc, $argv);
// set_route($kernel);
$r = new \Salarmotevalli\PhpChecker\Classes\Kernel($argc, $argv);
// $r->run();
