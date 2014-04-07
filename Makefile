all: test

coverage:
	vendor/bin/phpunit --coverage-clover coverage.clover

test:
	vendor/bin/phpunit --colors --verbose
