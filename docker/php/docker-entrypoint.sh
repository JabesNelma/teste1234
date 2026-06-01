#!/bin/bash
set -e

# Ensure writable folders exist
mkdir -p /var/www/html/writable
chown -R www-data:www-data /var/www/html/writable || true

# Avoid git safe-directory errors when project is bind-mounted from host
git config --global --add safe.directory /var/www/html || true

# If vendor not present or composer.json changed, run composer install
if [ ! -d "/var/www/html/vendor" ] || [ /var/www/html/composer.json -nt /var/www/html/vendor ]; then
  echo "Installing PHP dependencies via Composer..."
  composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader || true
fi

exec "$@"
