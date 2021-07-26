#!/usr/bin/env bash

source ./scripts/functions.sh

install_vendor

./scripts/setup-db.sh "$@"
