## Для разворота необходимо: 
### `git clone [Your repository URL]`
### `cd [Your Repository Name]`
### `composer install`
Создать файл .env со след. параметрами:
```
# In all environments, the following files are loaded if they exist,
# the latter taking precedence over the former:
#
#  * .env                contains default values for the environment variables needed by the app
#  * .env.local          uncommitted file with local overrides
#  * .env.$APP_ENV       committed environment-specific defaults
#  * .env.$APP_ENV.local uncommitted environment-specific overrides
#
# Real environment variables win over .env files.
#
# DO NOT DEFINE PRODUCTION SECRETS IN THIS FILE NOR IN ANY OTHER COMMITTED FILES.
#
# Run "composer dump-env prod" to compile .env files for production use (requires symfony/flex >=1.2).
# https://symfony.com/doc/current/best_practices/configuration.html#infrastructure-related-configuration

###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=176dec402425ed6f8dda326181e0e093
#TRUSTED_PROXIES=127.0.0.1,127.0.0.2
#TRUSTED_HOSTS='^localhost|example\.com$'
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# For a PostgreSQL database, use: "postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=11"
# IMPORTANT: You MUST also configure your db driver and server_version in config/packages/doctrine.yaml
DATABASE_URL=mysql://root:@127.0.0.1:3306/catalog_site
###< doctrine/doctrine-bundle ###

###> symfony/swiftmailer-bundle ###
# For Gmail as a transport, use: "gmail://username:password@localhost"
# For a generic SMTP server, use: "smtp://localhost:25?encryption=&auth_mode="
# Delivery is disabled by default via "null://localhost"
MAILER_URL=gmail://maternityhospital68@gmail.com:bccwhwzwlqbythxh@localhost
###< symfony/swiftmailer-bundle ###

```
Где DATABASE_URL=mysql://root:@127.0.0.1:3306/catalog_site - параметры коннекта к БД
###Выполнить миграции и сиды:
### `php bin/console make:migration`
### `php bin/console doctrine:migrations:migrate`
### `php bin/console doctrine:fixtures:load`
Администратор -  
логин - admin@admin.ru  
пароль - admin

####Доступы от почты с которой отправляется рассылка:
Maternityhospital68 Morf6673

###В админке  
при создании организации поле rating должно быть заполнено от 0 до 5.