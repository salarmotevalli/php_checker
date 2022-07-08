<?php

declare(strict_types=1);
namespace Salarmotevalli\PhpChecker;

/**
 * @return array
 */
function commands(): array
{
    return [
        'check' => [
            'import' => \Salarmotevalli\PhpChecker\Commands\CheckImport::class,
        ],
    ];
}
