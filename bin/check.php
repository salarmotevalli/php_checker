<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Kernel.php';

require_once __DIR__ . '/../route.php';
$kernel = new \Salarmotevalli\PhpChecker\Kernel($argc, $argv);
set_route($kernel);
$kernel->run();
