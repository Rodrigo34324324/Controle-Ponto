# Controle de Ponto - Clock Out

Controle de Ponto - Clock Out - é um protótipo de sistema Web para controle de ponto destinado a pequenas empresas. O sistema foi desenvolvido por Rodrigo do Nascimento Miranda, aluno do Instituto Federal de Educação, Ciência e Tecnologia, como Trabalho de Conclusão de Curso.

# Requisitos
* PHP 7
* MySQL 8.0

# Iniciando a aplicação

### Banco de dados
Para estruturar o banco com suas tabelas, relacionamentos, restrições, etc. vá até o arquivo controle_ponto_fisico.sql em database/ e rode a codificação no servidor de banco de dados MySQL Workbench.

### Backend
No arquivo conexão.php, localizado em App/, defina o nome de usuário e senha utilizados para se conectar ao seu servidor de banco de dados MySQL Workbench.<br>

Em funcionario.controller.php, localizado em App/, mais especificamente nas linhas 44 e 148, defina o caminho pra pasta img. A pasta img é o repositório de imagens de perfil dos funcionários.
Agora, devemos subir nosso serviço do backend. Para isso, vá até a pasta backend e rode o comando a seguir: <br>

Copie o caminho para a pasta public, abra o terminal e acesse a pasta public. Exemplo: cd: C:\Users\User\Desktop\TCC\public<br>
Uma vez acessada via terminal a pasta public, digite o seguinte comando para iniciar o servidor embutido do PHP: `php -S localhost:8080`

Agora nossa aplicação estará funcionando e podera ser acessada através da url: http://localhost:8080/

![FireShot Capture 00 - App Controle Ponto - localhost](https://user-images.githubusercontent.com/97996768/152341554-dbea05be-5604-4965-8142-2efdc700fe74.png)
![FireShot Capture 01 - App Controle Ponto - localhost](https://user-images.githubusercontent.com/97996768/152341566-6bc21721-2e3b-4dbd-b586-c73b6a5a8dba.png)
![FireShot Capture 02 - App Controle Ponto - localhost](https://user-images.githubusercontent.com/97996768/152341587-e6d8504f-ac03-43a8-82db-9dff846ad85d.png)

