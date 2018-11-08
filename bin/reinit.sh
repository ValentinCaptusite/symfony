#!/bin/bash

echo "Suppression de la base"
php bin/console doctrine:database:drop --if-exists --force --env=dev

echo "Creation de la base"
php bin/console doctrine:database:create --env=dev

echo "Creation du schema"
php bin/console doctrine:schema:create --env=dev

echo "Suppression des fichiers temporaires"
rm -rf var/cache/*
rm -rf var/logs/*
rm -rf var/sessions/*

# Import des fixtures
#php bin/console doctrine:fixtures:load --append --env=dev

php bin/console d:m:m --no-interaction