# fablab
Site de gestion du FabLab de CentraleLille

## Installation

Install dependencies:

```
composer install
npm install -g bower
bower install
```

Bower will install bootstrap for layout.

## Dev

We use the PSR-2 PHP Standard, you can test locally with this command :

```
./vendor/squizlabs/php_codesniffer/scripts/phpcs --standard=PSR2 src/
```
Use the code fixer with ```phpcbf``` instead of ```phpcs```

```
./vendor/squizlabs/php_codesniffer/scripts/phpcbf --standard=PSR2 src/
```

For windows :

```
php ./vendor/squizlabs/php_codesniffer/scripts/phpcs --standard=PSR2 src/ --no-patch
```
