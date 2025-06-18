# Project Deployment Guide

This guide will walk you through the steps needed to deploy this Filament Admin Panel for Ordering System.

## Prerequisites

Ensure the following are installed on your server:
- PHP (compatible version)
- Composer
- MySQL or your preferred database system

## Deployment Steps

Follow these steps to set up and deploy the project:

   ```bash
   cp .env.example .env
   php artisan key:generate
   composer install --no-dev --optimize-autoloader
   php artisan optimize
   php artisan route:cache
   php artisan cache:clear
   php artisan migrate
   ```