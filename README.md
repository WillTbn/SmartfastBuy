# Smart Fast Buy

#### -Pre-requisito

* php8.1
* composer
* docker(opcional)

#### -Instalando

1.Roda o para instalar as dependencias do projeto, na pasta do projeto

```php
composer install
```

2.cria o arquivo .env com as variaveis de ambiente, o .env.example esta de bom tamanho, rode

```php
cp .env.example .env
```

3.Roda o ".vendor/bin/sail up -d" para cria os containers necessarios para roda

```php
.vendor/bin/sail up -d
```

4.roda as migrations

```php
sail art migrate
```

5.roda as seed's

```php
sail art db:seed
```
