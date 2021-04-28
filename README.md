.checkout
=========

A Symfony project created on December 19, 2019, 8:44 am.

PHP 7.2.34

Symfony 3.4.47

1) in App/config create parameters.yml

2) composer update

3) php bin/console doctrine:database:create

4) php bin/console doctrine:schema:update

5) php bin/console doctrine:schema:update --dump-sql

6) php bin/console doctrine:schema:update --force

7) insert in table roles:
   id   role
   1    ROLE_USER
   2    ROLE_ADMIN

8) php bin/console server:run
 
