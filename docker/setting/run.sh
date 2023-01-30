cd ../../
php artisan migrate:fresh --seed
php artisan config:cache
