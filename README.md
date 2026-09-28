# Moodle composer skeleton

with dev dependency

Settings .env.


## container

### composer
Executs 'composer install'. See [composer.json](./container/composer/composer.json) for more details which dependencies get installed and which scripts get executed. There is also the possibility to import a SQL dump if a file 'sql/dump.sql' exists.

### php
PHP FPM Alpine. Contains the php.ini.

### web
Nginx server to serve the website.

### db

Mariadb server
