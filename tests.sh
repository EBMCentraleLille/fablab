#!/bin/bash

./vendor/squizlabs/php_codesniffer/scripts/phpcbf --standard=PSR2 src/
./vendor/squizlabs/php_codesniffer/scripts/phpcs --standard=PSR2 src/
