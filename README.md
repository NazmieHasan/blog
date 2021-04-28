.checkout
=========

A Symfony project created on December 19, 2019, 8:44 am.

PHP 7.2.34

Symfony 3.4.47

1) in App/config create parameters.yml

  database_host: 127.0.0.1
  database_port: 3306
  database_name: blog
  database_user: root
  database_password: null
  mailer_transport: smtp
  mailer_host: 127.0.0.1
  mailer_user: null
  mailer_password: null
  secret: 144e53837310232c759a0e73b4cba40cecfb1574
    
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
 
