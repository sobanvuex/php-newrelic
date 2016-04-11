#!/usr/bin/env bash

rm -fr build/docs build/gh-pages
./vendor/bin/apigen generate --config apigen.yml
GH_REV=$(git rev-parse --short HEAD)
git clone --depth=1 --branch=gh-pages git://github.com/SobanVuex/php-newrelic.git build/gh-pages
cd build/gh-pages && \
ls | xargs rm -rf && \
mv ../docs/* .
test -z "$(git log --grep ${GH_REV} --format='%s')" && \
git add . && \
git commit -m "Api @ ${GH_REV}" && \
git push -q
