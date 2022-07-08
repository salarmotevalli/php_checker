<?php

use Ergebnis\PhpCsFixer\Config;

$config = Config\Factory::fromRuleSet(new Config\RuleSet\Php81(), [
    'simplified_if_return' => true,
]);

$config->getFinder()->in(__DIR__);
$config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php-cs-fixer.cache');

return $config;
