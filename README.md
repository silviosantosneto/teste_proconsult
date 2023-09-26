# Teste admissional ProConsult

### Instalando o projeto

O projeto se utiliza de contêineres Docker, através do pacote *Laravel Sail* para facilitar a configuração do ambiente de desenvolvimento. Portanto, é necessário que já possua o Docker e o Docker Compose instalados na máquina.


Links para instalação e configuração de Docker:

- [Windows](https://docs.docker.com/docker-for-windows/install/)
- [Linux (Debian based)](https://docs.docker.com/engine/install/ubuntu/)

### Passos para o rodar o projeto localmente:

- Faça um clone do projeto para sua máquina local
- Crie um arquivo `.env`, recomendamos usar `.env-example` como base
- acesse a pasta do projeto via console (terminal/PowerShell/CMD)
- execute o comando:
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
 ```
- Após finalizado processamento, execute o comando `./sail up -d`


### [Modelagem do Banco de dados](https://drive.google.com/file/d/15c5pQoYAGss1CaP0BlBJnkqAzeDJDOxG/view)
