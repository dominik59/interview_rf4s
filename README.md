# interview_rf4s project

## Requirements
* Linux operation system
* Docker
* docker-compose

## How to use?
0. Run ./scripts/initial_build_docker_images.sh
0. Run ./scripts/start_dev_environment.sh
0. Application is available at http://localhost

## Available helpers
* ./scripts/api_composer_install.sh - allows run composer install on Symfony app
* ./scripts/api_composer_require.sh - allows execute composer require package_name on Symfony app
* ./scripts/api_composer_require_dev.sh - allows execute composer require --dev package_name on Symfony app
* ./scripts/initial_build_docker_images.sh - allows build required images for composer purposes
* ./scripts/start_dev_environment.sh - starts environment