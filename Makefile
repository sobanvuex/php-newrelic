all: test

before:
	composer install --dev

after:
	wget https://scrutinizer-ci.com/ocular.phar -O ocular.phar
	php ocular.phar code-coverage:upload --format=php-clover coverage.clover

coverage:
	vendor/bin/phpunit --coverage-clover coverage.clover

test:
	vendor/bin/phpunit --colors --verbose
