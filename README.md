# Secoucherplusgeek

![Secoucherplusgeek Logo](public/logo/logo.png)

Secoucherplusgeek (Go to bed more geek) is a Symfony 4 application to read and share anecdotes about IT.

## How to use this application

### First clone the git repository

    git clone https://github.com/Kevingili/Secoucherplusgeek.git
    
### Then move in folder
    cd Secoucherplusgeek
    
### Install composer dependencies
    composer install
    
### Update .env with your credentials about database
    DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name

### Create database
    php bin/console doctrine:database:create

### Make migrations
    php bin/console make:migrations

### Launch migrations
    php bin/console doctrine:migrations:migrate
    
### You can launch fixtures to get some data
    php bin/console doctrine:fixtures:load

### Start application !
    php bin/console server:run