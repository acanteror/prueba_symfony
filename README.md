SYMFONY 2.8 RENTING CAR PAGE EXAMPLE
==================================

Symfony project created for company Ñ Working skills test.  

INSTALLATION

1.- Clone de project

2.- Install composer dependencies

`composer install`

3.- Ensure you have a mysql run in your local

4.- Open parameters.yml file and update it

```
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: renting #or your database name
    database_user: root
    database_password: null
    mailer_transport: gmail 
    mailer_user: #your gmail account
    mailer_password: #your gmail account password
    secret: asecrettoken
    mailer_host: 127.0.0.1
```

5.- If you decide to use a new database (renting), create it

`php app/console doctrine:database:create`

6.- Create tables

`php app/console doctrine:schema:update --force`

7.- Load fixtures

`app/console doctrine:fixtures:load --append`

8.- Run de php server

`php app/console server:run`

9.- On browser open the url

`http://localhost:8000/index`




