#!/usr/bin/env bash

set -e

# Variables
ENVIRONMENT=${1}
CI_TRIGGER_TOKEN=${2}
DOCKER_TAG=${3:-latest}

function print_usage
{
    echo
    echo "Usage: deploy <ENVIRONMENT> <CI_TRIGGER_TOKEN> <DOCKER_TAG>"
    echo
    echo "Example:"
    echo "  deploy prod YOUR_CI_TRIGGER_TOKEN 1.0.2"
}

if [[ -z "${ENVIRONMENT}" ]]
then
    echo "No ENVIRONMENT specified."
    print_usage
    exit 1
fi

if [[ -z "${CI_TRIGGER_TOKEN}" ]]
then
    echo "No CI_TRIGGER_TOKEN specified."
    print_usage
    exit 1
fi

# Trigger CI Pipeline
curl -fsS -X POST \
    -F "token=${CI_TRIGGER_TOKEN}" \
    -F "ref=master" \
    -F "variables[ENV]=${ENVIRONMENT}" \
    -F "variables[TARGET]=cms-auth-deploy" \
    -F "variables[DOCKER_TAG]=${DOCKER_TAG}" \
    https://gitlab.com/api/v4/projects/8980863/trigger/pipeline
