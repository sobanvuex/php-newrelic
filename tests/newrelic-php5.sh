#!/bin/bash

# variables
PHP_API=${PHP_API:-$(php-config --extension-dir | cut -d '-' -f 4)}
PHP_EXTENSION_DIR=${PHP_EXTENSION_DIR:-$(php-config --extension-dir)}

# repository
wget -O - https://download.newrelic.com/548C16BF.gpg | sudo apt-key add -
echo "deb http://apt.newrelic.com/debian/ newrelic non-free" | sudo tee -a /etc/apt/sources.list
sudo apt-get update -qq
sudo apt-get install newrelic-php5

# install
cp /usr/lib/newrelic-php5/agent/x64/newrelic-$PHP_API-zts.so $PHP_EXTENSION_DIR/newrelic.so

# enable
echo "extension = newrelic.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
