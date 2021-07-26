#!/usr/bin/env bash

install_vendor() {

    if [[ ! -d "./vendor" ]]; then

        echo "Installazione vendor..."

        composer install
    fi
}
