.PHONY: test api coverage gh docs
.DEFAULT: test

PHP ?= php
GIT ?= git
GH_REF ?= github.com/SobanVuex/php-newrelic

test:
	$(PHP) vendor/bin/phpunit \
	--configuration phpunit.xml

api:
	rm -fr build/docs
	$(PHP) vendor/bin/apigen \
	generate \
	--config apigen.yml

coverage:
	$(PHP) vendor/bin/codacycoverage clover build/coverage.clover

gh:
	pwd
	$(GIT) clone --depth=1 --branch=gh-pages git://${GH_REF}.git build/gh-pages
	cd build/gh-pages
	ls -alF
	ls -alf ..
	pwd
	ls | xargs rm -rf
	mv ../docs/* .
	$(GIT) config user.name "${GH_USER}"
	$(GIT) config user.email "${GH_EMAIL}"
	$(GIT) add .
	$(GIT) commit -m "Api @ ${GH_REV}"
	$(GIT) push -q https://${GH_TOKEN}@${GH_REF}.git &> /dev/null

docs: api gh
