composer i
php artisan key:generate
configure .env file (database, JWT_SECRET, mail)
php artisan migrate --seed
php artisan jwt:secret
php artisan storage:link

test user - email john@doe.com, pass 12345678
