<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Kernel.php';

require_once __DIR__ . '/../route.php';
$kernell = new \Salarmotevalli\PhpChecker\Kernel($argc, $argv);
set_route();
$kernell->run();
