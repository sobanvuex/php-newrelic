NewRelic
========

| Quality / Metrics | Releases | Downloads | Licence |
| ----------------- | -------- | --------- | ------- |
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/SobanVuex/php-newrelic/badges/quality-score.png?s=60d5ad67e11392a438abd053311d24bbf06ecf79)](https://scrutinizer-ci.com/g/SobanVuex/php-newrelic/) | [![Latest Stable Version](https://poser.pugx.org/sobanvuex/php-newrelic/version.png)](https://packagist.org/packages/sobanvuex/php-newrelic) [![Latest Unstable Version](https://poser.pugx.org/sobanvuex/php-newrelic/v/unstable.png)](https://packagist.org/packages/sobanvuex/php-newrelic) | [![Composer Downloads](https://poser.pugx.org/sobanvuex/php-newrelic/d/total.png)](https://packagist.org/packages/sobanvuex/php-newrelic) | [![License](https://poser.pugx.org/sobanvuex/php-newrelic/license.png)](https://packagist.org/packages/sobanvuex/php-newrelic)

Requirements
------------

- PHP >=5.3
- cURL extension for the REST API
- newrelic extension for the Agent API

Installation
------------

Using Composer's command line interface:

```bash
php composer.phar require sobanvuex/php-newrelic:1.*
```

- - -

Manually adding the requirements to `composer.json`:

```js
"require": {
    "sobanvuex/php-newrelic": "1.*"
}
```

- - -

Don't forget to load Composer's autoloader

```php
require 'vendor/autoload.php';
```
