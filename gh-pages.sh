#!/usr/bin/env bash

git clone --depth=1 --branch=gh-pages git://${GH_REF}.git build/gh-pages
cd build/gh-pages && \
ls | xargs rm -rf && \
mv ../docs/* .
test -z "$(git status -z)" || \
git config push.default simple && \
git config user.name "${GH_AUTHOR}" && \
git config user.email "${GH_EMAIL}" && \
git add . && \
git commit -m "Api @ ${GH_REV}" && \
git push -q https://${GH_TOKEN}@${GH_REF}.git &> /dev/null
