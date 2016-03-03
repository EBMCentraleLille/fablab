#Fablab
Site de gestion du FabLab de CentraleLille

## Installation

Install dependencies:

```
composer install
npm install -g bower
bower install
```

Bower will install bootstrap for layout.


## Tests
### Tests unitaires

```
phpunit -c app
```

### Syntaxe

```
./vendor/squizlabs/php_codesniffer/scripts/phpcs --standard=PSR2 src/
```
### Syntaxe fix

```
./vendor/squizlabs/php_codesniffer/scripts/phpcbf src/
```



##Gestion des réservations

**par Romain, Medhi et Pierre-Louis**

Classes Event et Machine
