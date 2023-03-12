# API de gestão de eventos para agência de shows

Este projeto é uma API REST para a gestão de eventos de uma agência de shows. Ele permite criar, buscar, editar e excluir eventos, além de validar os dados de entrada de acordo com os requisitos de negócio definidos.

## Instalação

Para instalar e executar a aplicação, siga os passos abaixo:

Você está certo, o arquivo .env é importante para configurar as variáveis de ambiente e outras configurações da aplicação. Portanto, aqui está a versão atualizada das instruções com o passo para copiar o arquivo .env.example para .env:

Para instalar e executar a aplicação, siga os passos abaixo:

Clone o repositório

-   Abra o terminal e navegue até o diretório do projeto clonado
-   Execute o comando docker-compose up -d para construir e iniciar o ambiente docker
-   Execute o comando cp .env.example .env para criar o arquivo .env baseado no arquivo .env.example
-   Acesse a aplicação através do link http://localhost:8000
-   Execute o comando docker exec -it tfteste_app bash para acessar o container da aplicação
-   Execute o comando composer install para instalar as dependências do projeto
-   Execute o comando php artisan key:generate para criar a chave do projeto
-   Execute o comando php artisan migrate:fresh --seed para criar as tabelas e popular o banco de dados com dados de exemplo
-   Acesse a documentação da API através do link http://localhost:8000/api/documentation

</ul>

## Executando os testes

Para executar os testes da aplicação, siga os passos abaixo:

1. Acesse o container da aplicação utilizando o comando `docker exec -it tfteste_app bash`
2. Execute o comando `php artisan test`
