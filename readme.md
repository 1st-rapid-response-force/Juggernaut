# RRF Juggernaut

Juggernaut is a custom built PHP web application based on Laravel that provides unit management and personnel tracking facilities for our ARMA 3 Military Simulation Unit: [The 1st Rapid Response Force](https://1st-rrf.com)

# Setting up a Development Environment

Juggernaut uses a docker compose based development environment. To setup a development environment ensure you have Docker Compose installed.

To get started run:

```docker-compose up -d```

This will start the development environment.

Before you can load the site you will need to run the initialization commands. To open a SSH session into the development container run:

```chmod +x dev_connect.sh && ./dev_connect.sh```

Once you are inside the dev container navigate to the application directory at:

```cd /var/www/laravel```

From here you can run the following initialization commands:

```composer install```
```php artisan key:generate```
```php artisan migrate```
```php artisan db:seed```

At this point the site should be accessible on [localhost:4040](https://localhost:4040)

