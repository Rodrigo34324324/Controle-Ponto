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

![WhatsApp Image 2022-01-25 at 21 55 44](https://user-images.githubusercontent.com/97996768/151674496-5f642950-e21e-4c2d-90c5-804c4bae80ce.jpeg)
![WhatsApp Image 2022-01-25 at 21 56 09](https://user-images.githubusercontent.com/97996768/151674498-16f7cd3d-ddc5-40d7-b9d3-c7d490797f2d.jpeg)
![WhatsApp Image 2022-01-25 at 21 56 30](https://user-images.githubusercontent.com/97996768/151674501-7afb5d2f-493f-4b6e-bd7e-7a87de89aebc.jpeg)
![WhatsApp Image 2022-01-25 at 21 57 56](https://user-images.githubusercontent.com/97996768/151674502-838b6482-f55c-4670-975f-e699b12828b3.jpeg)
![WhatsApp Image 2022-01-25 at 22 02 55](https://user-images.githubusercontent.com/97996768/151674503-c6f0294a-4cc4-4dfa-b87a-e3e05d27385d.jpeg)
