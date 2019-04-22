# Instruções

Primeiro faça a clonagem com `git clone https://github.com/roqueando/netshow-test.git`

## instalação

```bash
composer install
```



## inicialização

```bash
php -S localhost:8000 -t public
```



### configurações

#### .env

```env
APP_NAME=NetshowTest
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=netshow_test
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=aa18308b8a1241
MAIL_PASSWORD=1c0a3da7d5d3d2
MAIL_PORT=25
MAIL_SECURE=tls
MAIL_TO=contato@test.com
MAIL_TO_NAME='Test Contact'
```

##### ** Caso haja a necessidade de trocar o username e password troque no MAIL_USERNAME e MAIL_PASSWORD

##### ** MAIL_TO e MAIL_TO_NAME é o destinatário do e-mail (normalmente o dono do site)

#### Database

`MySQL 5.7`

