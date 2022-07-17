<?php

declare(strict_types=1);

function commands(): array
{
    return [
        'check' => [
            'import' => \Salarmotevalli\PhpChecker\Commands\CheckImport::class,
            'dd' => \Salarmotevalli\PhpChecker\Commands\CheckDD::class,
        ],
        'short' => [
            'namespace' => \Salarmotevalli\PhpChecker\Commands\ShortNamespace::class,
        ],
    ];
}
