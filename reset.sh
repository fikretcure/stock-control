docker exec -it workspace bash -c "composer update"
docker exec -it workspace bash -c "php artisan migrate:fresh --seed"
