# Tourbinou Test

Teste Técnico para vaga de Desenvolvedor Full-Stack na Tourbinou.

## Pré-requisitos

Antes de começar, você precisa ter as seguintes ferramentas instaladas:

- [PHP](https://www.php.net/downloads) (>= 8.0)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/) (>= 14.x)
- [NPM](https://www.npmjs.com/get-npm) (instalado automaticamente com o Node.js)

## Instalação

Siga os passos abaixo para clonar e configurar o projeto localmente:

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/GustavoViniciusDev/Tourbinou-Test.git
   ```

2. **Navegue até o diretório do projeto:**

   ```bash
   cd Tourbinou-Test
   ```

3. **Instale as dependências do PHP:**

   ```bash
   composer install
   ```

4. **Crie um arquivo `.env` a partir do arquivo de exemplo:**

   ```bash
   cp .env.example .env
   ```

5. **Gere a chave da aplicação:**

   ```bash
   php artisan key:generate
   ```

6. **Configure seu banco de dados no arquivo `.env`:**

   Altere as seguintes linhas no seu arquivo `.env` de acordo com seu ambiente:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nome_do_banco
   DB_USERNAME=usuario
   DB_PASSWORD=senha
   ```

7. **Execute as migrações:**

   ```bash
   php artisan migrate
   ```

8. **Instale as dependências do Node.js:**

   ```bash
   npm install
   ```

9. **Compile os ativos:**

   ```bash
   npm run dev
   ```

## Executando o Projeto

Para iniciar o servidor de desenvolvimento, execute:

```bash
php artisan serve
```

Agora você pode acessar a aplicação em `http://localhost:8000`.

## Estrutura do Projeto

- **app/**: Contém o código-fonte da aplicação.
- **resources/js/**: Contém o código Vue.js.
- **routes/**: Define as rotas da aplicação.
- **database/**: Contém as migrações e seeders.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para enviar um pull request.

## Licença

Este projeto é licenciado sob a [MIT License](LICENSE).
