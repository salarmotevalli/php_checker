<?php

declare(strict_types=1);

function commands(): array
{
    return [
        'short' => [
            'namespace' => \Salarmotevalli\PhpChecker\Commands\ShortNamespace::class,
        ],
    ];
}
