# PHP NewRelic

[![Source Code](http://img.shields.io/badge/source-SobanVuex/php--newrelic-blue.svg?style=flat-square)](https://github.com/SobanVuex/php-newrelic)
[![Packagist Version](https://img.shields.io/packagist/v/SobanVuex/php-newrelic.svg?style=flat-square)](https://packagist.org/packages/SobanVuex/php-newrelic)
[![Build Status](https://img.shields.io/travis/SobanVuex/php-newrelic/master.svg?style=flat-square)](https://travis-ci.org/SobanVuex/php-newrelic)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/SobanVuex/php-newrelic.svg?style=flat-square)](https://scrutinizer-ci.com/g/SobanVuex/php-newrelic/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/SobanVuex/php-newrelic.svg?style=flat-square)](https://scrutinizer-ci.com/g/SobanVuex/php-newrelic)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/4c21f796-a06e-412c-84e9-e4a415b9ed22.svg?style=flat-square)](https://insight.sensiolabs.com/projects/4c21f796-a06e-412c-84e9-e4a415b9ed22)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/SobanVuex/php-newrelic.svg?style=flat-square)](https://packagist.org/packages/SobanVuex/php-newrelic)

OOP Wrapper for NewRelic's PHP Agent.

## Installation

To install, use composer:

```
composer require SobanVuex/php-newrelic:~2.0
```

## Usage

Use the Agent directly or with your own DI with `\SobanVuex\NewRelic\Agent`.
Or using `Pimple` with `\SobanVuex\NewRelic\Provider\Pimple\AgentPrivoder`.

### Examples

Setting the application name

```php
$newrelic = new SobanVuex\NewRelic\Agent('MyApp');
// or
$newrelic = new SobanVuex\NewRelic\Agent('MyApp1;MyApp2');
// or
$newrelic = new SobanVuex\NewRelic\Agent(['MyApp1', 'MyApp2']);
```
```php
$newrelic = new SobanVuex\NewRelic\Agent();
$newrelic->setAppname('MyApp');
// or
$newrelic->setAppname('MyApp1;MyApp2');
// or
$newrelic->setAppname(['MyApp1', 'MyApp2']);
```

Mark a transaction as a background job

```php
$newrelic = new SobanVuex\NewRelic\Agent();
$newrelic->backgroundJob();
// or
$newrelic->backgroundJob(PHP_SAPI == 'cli');
```

Name a transaction

```php
$newrelic = new SobanVuex\NewRelic\Agent();
$newrelic->nameTransaction('myController/myAction');
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/SobanVuex/php-newrelic/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Alex Soban](https://github.com/SobanVuex)
- [All Contributors](https://github.com/SobanVuex/php-newrelic/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/SobanVuex/php-newrelic/blob/master/LICENSE) for more information.
