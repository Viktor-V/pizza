# Setup

1. Run build: ```docker-compose build --pull --no-cache```
2. Run services: ```docker-compose up -d```
3. Run migrations and fixtures:
```
docker exec -it pizza_php_1 php bin/console doctrine:migrations:migrate
docker exec -it pizza_php_1 php bin/console doctrine:fixtures:load
```
4. Generate assets:
```
docker-compose run encore yarn --cwd /srv/app install
docker-compose run encore yarn --cwd /srv/app dev
```
6. Open ```https://localhost``` in your favorite web browser and accept the auto-generated TLS certificate
