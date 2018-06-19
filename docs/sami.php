<?php

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$dir = dirname(__DIR__);

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('docs')
    ->exclude('tests')
    ->in($dir)
;

$versions = GitVersionCollection::create($dir)
    ->addFromTags('1.*')
    ->addFromTags('2.*')
    ->add('master', 'Master')
;

return new Sami($iterator, [
    'versions' => $versions,
    'title' => 'PHP NewRelic',
    'build_dir' => __DIR__ . '/public/sf2/%version%',
    'cache_dir' => __DIR__ . '/cache/sf2/%version%',
    'remote_repository' => new GitHubRemoteRepository('SobanVuex/php-newrelic', dirname($dir)),
    'default_opened_level' => 2,
]);
