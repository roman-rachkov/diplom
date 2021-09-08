#!/bin/bash

release=$1
task=$2

git branch "$release"
git pull origin "$release"
git branch "$task"
git checkout "$task"
bash ./vendor/bin/sail up
bash ./vendor/bin/sail composer install


#echo `git branch $1`
#echo `git pull $1`
#echo `git branch $2`
#echo `git checkout $`

#bash git $1
#bash ./vendor/bin/sail composer install
#bash ./vendor/bin/sail artisan migrate:fresh
#bash ./vendor/bin/sail npm install
#bash ./vendor/bin/sail npm run dev
#bash ./vendor/bin/sail artisan db:seed \\Database\\Seeders\\DemoDataSeeders\\DemoDataSeeder