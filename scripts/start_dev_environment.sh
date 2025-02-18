#!/usr/bin/env bash

script_dir=$(realpath "$(dirname "$0")")
main_project_dir=${script_dir}/..

cd "${main_project_dir}" || exit
"${script_dir}"/api_composer_install.sh
env UID=$UID GID=$GID docker-compose -f docker-compose-dev.yml up --build --force-recreate
