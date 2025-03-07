#!/bin/bash

if [ "$2" == "-db" ]
then
echo "rebuilding database ..."
php bin/console doctrine:schema:drop -n -q --force --full-database
rm src/Migrations/*.php
php bin/console make:migration
php bin/console doctrine:migrations:migrate -n -q
php bin/console doctrine:fixtures:load -n -q
fi

if [ -n "$1" ]
then
./bin/phpunit $1
else
./bin/phpunit
fi
