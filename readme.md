# ALGÉBRICO!

## A PHP Laravel Framework based personal finance app for people

This is a simple app to help people to manage their own money, in a cloud based app. To run it, you will need:

* A web host that run PHP and MySQL

## Getting start

ALGÉBRICO works both in a standard installation (under apache), or via Docker

### Standard

1) Create a MySQL database (utf8-8 unicode)


2) You'll have to change the following files:

* .env - fill the database credencials properly
* 000-algebrico.conf - (optional)

3) Get Composer and Install the application:

`
$ /usr/bin/curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
$ cd /var/www/html # This is the directory you put the source code
$ /usr/local/bin/composer install
 `

4) Import the tables to the database
`
$ php artisan migrate:refresh --seed
`

### Docker

1) You'll need another container running a MySQL database. I recommend [MariaDB](https://hub.docker.com/_/mariadb/). Configure the MYSQL_ROOT_PASSWORD environment variable

2) The .env file is already configured with environment variables, that you have to fill when you run the container, as follows:

* DB_HOST
* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD

3) Access the container:

`
$ docker exec -it [container_name] /bash
`

4) Inside the container, import the tables to the database:

`
$ php artisan migrate:refresh --seed
`

## Helpers, librarys, frameworks, etc

*Interface*

* [Bootstrap](http://getbootstrap.com/)

*Javascript*

* [JQuery](http://jquery.com/)
* [JQueryUI Datepicker](https://jqueryui.com/datepicker/)
* [MaskMoney](http://plentz.github.io/jquery-maskmoney/)
* [dhtmlxCombo](http://dhtmlx.com/docs/products/dhtmlxCombo/) | [Documentation](http://docs.dhtmlx.com/combo__index.html)

## Wow, there's a lot of bugs, man...

I know. There's a lot to do. A lot. I have a Trello board with many cards, lots to do and several known bugs and improvements. I'm working on it in my free time. If you want to help, let me know and I'll give you access (in portuguese, but we can fix that)