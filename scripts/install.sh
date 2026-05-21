#!/usr/bin/env sh
set -e

cd "$(dirname "$0")/.."

echo "Applying database schema..."
docker compose exec -T mysql mysql -ublog -pblog blog < database/schema.sql

echo "Installing Composer dependencies..."
docker compose exec php composer install --no-interaction

echo "Seeding database..."
docker compose exec php composer run seed

echo "Building CSS..."
if command -v npm >/dev/null 2>&1; then
    npm install
    npm run build:css
else
    echo "npm not found — skip CSS build or run: npm install && npm run build:css"
fi

echo "Done. Open http://localhost:8080"
