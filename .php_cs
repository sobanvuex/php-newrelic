<?php

$header = <<<'EOF'
This file is part of the PHP New Relic package.

(c) Alex Soban <me@soban.co>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

return PhpCsFixer\Config::create()
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP70Migration' => true,
        'array_indentation' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'combine_consecutive_issets' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        'header_comment' => [
            'header' => $header,
        ],
        'fully_qualified_strict_types' => true,
        'linebreak_after_opening_tag' => true,
        'method_chaining_indentation' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => true,
    ])
    ->setFinder($finder)
;
