#!/usr/bin/env bash

set -e

# Variables
ENVIRONMENT=${1:-dev}

if [[ ${ENVIRONMENT} == prod ]]
then
    COMPOSER_NO_DEV=--no-dev
else
    COMPOSER_NO_DEV=""
fi

function print_usage
{
    echo
    echo "Usage: build <ENVIRONMENT>"
    echo
    echo "Example:"
    echo "  build prod"
}

function build_composer()
{
    echo "Run Composer with option ${COMPOSER_NO_DEV}.."
    composer install ${COMPOSER_NO_DEV} --optimize-autoloader --ignore-platform-reqs
}

function build_bower()
{
    echo "Run Bower.."
    bower install --allow-root && bower prune -p --allow-root
}

build_composer
build_bower
