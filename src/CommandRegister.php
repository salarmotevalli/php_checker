<?php

declare(strict_types=1);

function commands(): array
{
    return [
        'check.php' => [
            'import' => \Salarmotevalli\PhpChecker\Commands\CheckImport::class,
            'dd' => \Salarmotevalli\PhpChecker\Commands\CheckDD::class,
        ],
    ];
}
