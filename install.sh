#!/bin/bash

release=$1
task=$2

git branch "$release"
git pull origin "$release"
git checkout -b "$task"
bash ./vendor/bin/sail up &
bash ./vendor/bin/sail composer install
bash ./vendor/bin/sail npm install
bash ./vendor/bin/sail npm run dev