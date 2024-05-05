# ztpai
ztpai - Fiszlet


## Database
```
cd App
docker-compose -f docker-compose.yml up -d
```

## Symfony
```
cd App
symfony server:start -d
composer install
php bin/console doctrine:migrations:migrate
```

## Angular
```
cd Front
ng serve
```