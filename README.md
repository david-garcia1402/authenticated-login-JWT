# Laravel JWT Authentication with Cookies

Este projeto Laravel apresenta um sistema de autenticação de login usando JWT (JSON Web Tokens) e cookies para autenticação em todos os métodos através de API. Essa abordagem fornece uma camada adicional de segurança e facilidade de uso.

## Requisitos

Certifique-se de que seu ambiente atenda aos seguintes requisitos antes de começar:

- [PHP](https://www.php.net/) >= 7.4
- [Composer](https://getcomposer.org/) para gerenciamento de dependências
- [Node.js](https://nodejs.org/) e [NPM](https://www.npmjs.com/) para o front-end (se aplicável)
- [Laravel](https://laravel.com/) >= 8.x instalado
- Um banco de dados compatível com Laravel (por exemplo, MySQL, PostgreSQL, SQLite)

## Instalação

1. Clone este repositório:

   ```bash
   git clone https://github.com/david-garcia1402/authenticated-login-JWT.git

2. Copie o arquivo .env.example para .env e configure o banco de dados:

   ```bash
    cp .env.example .env   
3. Execute as migrações e as sementes para criar as tabelas no banco de dados (irá criar o usuário root):
   ```bash
    sail artisan migrate --seed

## Autenticação

 - Este sistema utiliza autenticação JWT com cookies para todos os métodos através de API. Para autenticar, você pode usar as rotas padrão do Laravel:

 - POST /api/login: Para realizar o login e obter um token JWT.

 - POST /api/logout: Para efetuar o logout e invalidar o token.

## Rotas Protegidas

 - As rotas protegidas exigem autenticação. Certifique-se de incluir o token JWT válido no cabeçalho de autorização da solicitação.
