<?php

declare(strict_types=1);
function set_route(Salarmotevalli\PhpChecker\Kernel $kernel): void
{
    $kernel->route->setOption('check');
}
