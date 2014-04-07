all: clean

test:
	vendor/bin/phpunit --colors --coverage-clover=build/coverage.clover

clean:
	rm -rf build/*