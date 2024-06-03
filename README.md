# Fiszlet
Project for classes: "Zaawansowane technologie projektowania aplikacji internetowych" on the Cracow University of Technology.

Application is a collection of sets of flashcards, containing English-Polish translation of words about various subjects.


## Table of contents
- Technologies
- Installation
- Maintainers


## Technologies
- Symfony 7
- Angular 17
- Docker
- PostgreSQL


## Installation
First you need to make sure you have the following dependencies on your system:
- PHP 8.3.6
- node.js 20.12.2
- docker

### Database
From project root directory:
```
cd App
docker-compose -f docker-compose.yml up -d
```

### Back
From project root directory:
```
cd App
composer install
php bin/console doctrine:migrations:migrate
symfony server:start -d
```

### Front
From project root directory:
```
cd Front
npm install
ng serve
```

## Maintainers

- Filip Mysior - [github](https://github.com/Filip-Mysior)