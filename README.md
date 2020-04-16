# interview_rf4s project

## Requirements
* Linux operation system
* Docker
* docker-compose

## How to use?
0. Run ./scripts/initial_build_docker_images.sh
0. Run ./scripts/api_jwt_regenerate_keys.sh
0. Run ./scripts/start_dev_environment.sh
0. Run ./scripts/api_symfony_run_command.sh doctrine:migrations:migrate and confirm with y
0. Run ./scripts/api_symfony_run_command.sh doctrine:fixtures:load and confirm with y
0. Application is available at http://localhost

## Available helpers
* ./scripts/api_composer_install.sh - run composer install on Symfony app
* ./scripts/api_composer_require.sh - execute composer require package_name on Symfony app
* ./scripts/api_composer_require_dev.sh - execute composer require --dev package_name on Symfony app
* ./scripts/initial_build_docker_images.sh - build required images for composer purposes
* ./scripts/api_jwt_regenerate_keys.sh - regenerate jwt keys
* ./scripts/start_dev_environment.sh - starts environment

## How to tune
At ./app/api/app/.env you have got two environmental variables:
* OPENING_START_HOUR - Hairdresser opening start hour
* OPENING_END_HOUR - Hairdresser opening end hour

With these two variables you can dynamically tune opening 
hours.