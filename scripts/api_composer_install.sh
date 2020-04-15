#!/usr/bin/env bash

script_dir=$(realpath "$(dirname "$0")")
api_project_path=${script_dir}/../app/api/app

cd "${api_project_path}" || exit
docker run --network="interviewrf4s_db_network" --rm -it --volume "$(pwd)":/app composer-pgsql composer install
