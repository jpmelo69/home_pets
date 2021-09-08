Requisitos. Para esse artigo você deve ter instalado em seu computador o Laravel 8 e a versão 8 ou maior do PHP e as extensões OpenSSL PHP, PDO PHP, Mbstring PHP, Tokenizer. Também precisará ter instalado o Composer, um servidor como Apache/Nginx e um editor de código ou IDE de sua preferência.

1° Faça um fork deste repositório;
2° Abra o projeto na IDE de sua preferência;
3° No prompt execute o comando --composer update;
4° Crie um db no seu servidor local e configure o arquivo .env;
5° No prompt execute o comando --php artisan key:generate;
6° No prompt execute o comando --php artisan migrate:fresh --seed;
7° No prompt execute o comando --php artisan serve;
8° Seu projeto irá iniciar na porta 8000 que é a porta padrão do laravel.
