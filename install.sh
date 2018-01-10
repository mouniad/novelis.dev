#!/bin/bash
composer update
php artisan migrate
cd public
bower update
