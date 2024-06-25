#!/bin/bash

# Ensure the script exits if any command fails
set -e

# Run composer install
echo "Running composer install..."
composer install

# Copy .env.example to .env
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