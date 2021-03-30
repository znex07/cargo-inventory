<p>Installation</p>

create cargodb
cp .env.example .env
edit db .env

cd /cargo-inventory
composer install/update
php artisan key:generate
npm install
npm run watch
php artisan serve