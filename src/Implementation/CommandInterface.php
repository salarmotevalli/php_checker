<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Implementation;

interface CommandInterface
{
    public function run(): void;
    public function welcom(): string;
}
