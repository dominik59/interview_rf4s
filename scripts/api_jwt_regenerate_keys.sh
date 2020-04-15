#!/usr/bin/env bash

script_dir=$(realpath "$(dirname "$0")")
api_project_path=${script_dir}/../app/api/app

cd "${api_project_path}" || exit
docker run --rm -it --volume "$(pwd)":/app --workdir="/app" php:alpine sh -c '
    set -e
    apk add openssl
    apk add acl
    mkdir -p config/jwt
    jwt_passphrase=$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')
    echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
    echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
'