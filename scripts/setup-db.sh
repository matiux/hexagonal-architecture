#!/usr/bin/env bash

command1=""
command2=""
environment=""
while test $# -gt 0; do

  case "$1" in
  --force)
    command1="./sf doctrine:database:drop --force --if-exists"
    command2="./sf doctrine:database:create --if-not-exists"
#    ./sf doctrine:database:drop --force --if-exists
#    ./sf doctrine:database:create --if-not-exists
    ;;
  --env=test)
    environment="--env=test"
    ;;
  --env=dev)
    environment="--env=dev"
  esac
  shift
done

command1="$command1 $environment"
command2="$command2 $environment"

bash -c "$command1"
bash -c "$command2"

#bash -c "./sf doctrine:migration:migrate --no-interaction $environment"
bash -c "./sf doctrine:schema:update --force $environment"

exit 0
