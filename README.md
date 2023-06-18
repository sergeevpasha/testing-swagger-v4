## Test App

### How to run

1. cp .env.example .env
2. Change `DOCKER_NGINX_PORT` and `DOCKER_PGSQL_PORT` to desired ports or leave as is / delete if not needed
3. Run `make up` or if you are on windows with no makefile installed run `docker-compose up -d`
4. Run `make bash` or `docker exec -it laravel-test-app_php bash`
5. Run `composer install`
6. Run `php artisan key:generate`
7. Run `npm install`
8. Run `npm run build`
9. Run `php artisan migrate`
10. Run `php artisan db:seed`
11. Open web page on `http://localhost:<DOCKER_NGINX_PORT>`

Tests mainly written for Products API + some basic for Auth (WEB)

Run `composer test-html` to generate html report. Current coverage is `76.79%`
