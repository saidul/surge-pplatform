#!/bin/bash
BASEDIR=$(dirname $0)
$BASEDIR/../app/console doctrine:schema:drop --force
$BASEDIR/../app/console doctrine:schema:update --force
$BASEDIR/../app/console doctrine:fixtures:load