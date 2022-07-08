<?php

declare(strict_types=1);

function commands(): array
{
    return [
        'check' => [
            'import' => \Salarmotevalli\PhpChecker\Commands\CheckImport::class,
        ],
    ];
}
