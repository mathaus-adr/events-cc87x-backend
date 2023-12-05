# Instalação

## Pré-requisitos
    - Docker
    - Docker Compose

## Instalação
    - Clone o repositório
    - Execute o comando `composer install`
    - Execute o comando `cp .env.example .env`
    - Execute o comando `./vendor/bin/sail up -d`
    - Execute o comando `./vendor/bin/sail artisan key:generate`    
    - Execute o comando `./vendor/bin/sail artisan migrate`
    - Acesse o endereço `http://localhost:8080/` para postman
    - Docker inspect <container_id> para pegar o ip de gateway do container
    - Acesse o endereço `http://<ip_gateway>/` para setar a base_url no provider HttpService do flutter
