#!/bin/sh
set -e

echo "Deploying application ..."

    php artisan migrate --force
    # Clear cache
    php artisan optimize

echo "Application deployed!"
