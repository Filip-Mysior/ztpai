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
composer install
php bin/console doctrine:migrations:migrate

php bin/console lexik:jwt:generate-keypair

symfony server:start -d
```

## Angular
```
cd Front
npm install
ng serve
```