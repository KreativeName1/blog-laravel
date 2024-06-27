#!/bin/bash
# This script is used to setup the application for the first time after cloning the repository

# How to use:
# 1. Run `chmod +x setup.sh` to make this script executable
# 2. Run `./setup.sh` to execute this script

# Ensure the script exits if any command fails
set -e

# install composer dependencies
echo "Running composer install..."
composer install

# copie .env.example to .env file
echo "Copying .env.example to .env..."
cp .env.example .env

# Generate application key
echo "Generating application key..."
php artisan key:generate

# Run database migrations
echo "Running migrations..."
php artisan migrate

# Seed the database
echo "Seeding the database..."
php artisan db:seed

# Serve the application
echo "Serving the application..."
php artisan serve