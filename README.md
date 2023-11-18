# vizin.io <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" /> <img src="https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white" />  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" /> <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" />


Esse projeto foi criado para a cadeira Projeto Integrador do 4º semestre do tecnólogo de Análise e Desenvolvimento de Sistemas da Faculdade Senac.

O projeto Vizin.IO é uma aplicação web que utiliza a linguagem de programação PHP e o banco de dados MariaDB. O objetivo da aplicação é criar uma rede social de bairro, onde os vizinhos podem se conhecer, fomentar eventos locais e melhorar o bairro onde moram. Através do Vizin.IO, os usuários podem criar perfis, adicionar amigos, criar e participar de eventos, bem como trocar mensagens e compartilhar informações relevantes para a comunidade.

Observação: por ser um projeto de faculdade, as tecnologias utilizadas se limitam às cadeiras apresentadas pelo curso. A entrega do semestre se refere a uma funcionalidade do sistema, por isso, o mesmo não está completo.

## Autores

| [<img src="https://avatars.githubusercontent.com/u/7684192" width=80><br><sub>Jéssica Rodrigues</sub>](https://github.com/jessicasrodrigues)  | [<img src="https://avatars.githubusercontent.com/u/125749367?v=4" width=80><br><sub>Gisele Bittencourt</sub>](https://github.com/GiseleAquistapace)  |  [<img src="https://avatars.githubusercontent.com/u/14103735" width=80><br><sub>Felipe Craveiro</sub>](https://github.com/flpcnc) |
|---|---|---|
|  [<img src="https://avatars.githubusercontent.com/u/120474188" width=80><br><sub>Kauan Yamada</sub>](https://github.com/KauanYamada) | [<img src="https://avatars.githubusercontent.com/u/133287720" width=80><br><sub>Gleyco da Silva</sub>](https://github.com/mathmsd)  | [<img src="https://avatars.githubusercontent.com/u/99621069" width=80><br><sub>Samuel Gomes</sub>](https://github.com/SamuelCrepaldi)  |


## Instalação

#### Versões utilizadas no desenvolvimento:
* PHP 8.0.28
* Apache 2.4.56
* MariaDB 10.4.28

#### Setup do banco de dados: execute os arquivos dentro da pasta `bd` na ordem:
* `meu_banco.sql`
* `post.sql`

Atentar dados de conexão em `conexao.php`.

#### Outras instruções:
* Esse projeto usa mod_rewrite no htacess para o index.php - Certifique-se que o Apache está com AllowOverride All
* Habilitar o PDO Mysql no `php.ini`
* Configure no hosts do seu SO: `127.0.0.1 vizin.io`
* Se você está usando o xampp, configure no htdocs do seu Apache o DocumentRoot para a pasta do projeto vizin.io. Exemplo:
```
DocumentRoot "C:/xampp/htdocs/Vizin.IO"
```
* Também no htdocs, atualize o Directory:
```xml
<Directory "C:/xampp/htdocs/Vizin.IO">
```

Não se esqueça que após mexer nas configurações do servidor, você terá que reiniciar o servidor.

## Funcionalidades:
#### Visualizar locais que possuem postagem
![Visualização do mapa com pins](prints/post.PNG)

#### Visualizar postagens
![Visualização dos posts de um local](prints/post1.PNG)

#### Realizar postagem
![Criação de postagem](prints/post2.PNG)
=======
# Vizin.IO
Projeto de app para Atividade da Graduação do SENAC
