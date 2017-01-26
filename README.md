# Desafio Materate

### Decisões
* Assumi que o usuário admin já estará no sistema, pois não existia um cadastro de admin nos termos de aceite. 
* Como não conhecia Laravel, eu achei um pouco desorganizado como ele coloca os models na raiz, então criei uma pasta Model. 
* Dividi os controllers em duas pastas diferentes: API e Web. 
* Criei uma camada a mais de código, onde se encontra os métodos ligados a regras de negócio, sendo assim o código pode ser reaproveitado em mais de um controller. 
* Auth Api: achei que a autenticação de api que o Laravel utiliza (Passport) desnecessariamente complexo para o nosso sistema que era simples, então resolvi criar um auth proprio.

###Como Instalar

####WEB/API####
1. Baixar o projeto e entrar na pasta web
2. composer install (baixar as dependencias do projeto)
3. Configurar o banco no .env para o banco da máquina
4. Criar database: create database desafio_materate
5. Rodar as migrations: php artisan migrate
6. Rodar os seeders: php artisan db:seed
7. Rodar o servidor: php artisan serve 
8. Pode acessar o portal: http://localhost:8000 

> Login: admin@test.com.br

> Senha: admin123

###APP
Apesar de ter pedido mais tempo para fazer o App, como não conhecia o Laravel acabei perdendo muito tempo nele e com CORS, consegui resolver este problema. 

Infelizmente não consegui terminar o app no prazo. Estava utilizando o Cordova, para fazer com que o app seja hibrido. 

Apenas foi feito o Login do app. As próximas ações a serem feitas, era gravar o token que vem no cookie do servidor e começar a consumir o resto das apis. 

###Próximos passos (que seriam feitos)
1. Finalizar o App
2. Criar uma tela para inserção de usuários admins. 
3. Testes unitários
4. Não permitir deletar ou editar o perfil do usuario logado.
5. Subir o sistema para um servidor


