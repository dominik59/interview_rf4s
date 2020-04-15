#!/usr/bin/env bash

script_dir=$(realpath "$(dirname "$0")")
dockerfilepath=${script_dir}/../.docker/composer

cd "${dockerfilepath}" || exit
docker build -t composer-pgsql .
