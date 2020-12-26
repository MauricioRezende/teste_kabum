Para execução do projeto estou utilizando Apache 2.4 e PHP 7.2 configurados no WampServer 3.1.

Dentro da pasta "conf", há um arquivo chamado "connection.php", nele está configurado o acesso ao banco de dados, onde estou utilizando o servidor "localhost", usuário "root", senha em branco "" e nome do banco de dados "test_kabum". Caso utilize configurações diferentes de conexão com banco de dados, basta alterar esse arquivo.

Dentro da pasta "sql", há um arquivo chamado "create.sql", onde, basta criar um banco de dados chamado "test_kabum" (caso utilize outro nome, lembre-se de alterar o arquivo "connection.php" citado acima) e executar o script salvo no arquivo ou importa-lo.

Há um usuário de administrador já criado na base de dados, utilize "adm@gmail.com" e "12345" como usuário e senha respectivamente para acessar.

O teste foi desenvolvido por completo.

Se o usuário não realizar nenhuma ação dentro de 3 horas sua sessão é encerrada.

Se um usuário tentar acessar uma página exclusiva de outro perfil sua sessão é encerrada.

Para o cadastro de cliente o preenchimento dos campos estão sendo validados tanto no front-end quanto no back-end.

O usuário de perfil administrador pode:

-Alterar sua senha;

-Visualizar os clientes cadastrados;

-Cadastrar, editar e excluir um cliente;

-Cadastrar, editar e excluir endereços de um cliente.

O usuário de perfil cliente pode:

-Alterar sua senha;

-Alterar seus dados cadastrados;

-Cadastrar, editar e excluir endereços.

O cadastro de cliente por ser feito pelo próprio cliente ou por um usuário administrador.

O CPF não pode se repetir, onde, com isso, é verificado, logo após ser digitado, se o mesmo já foi cadastrado, caso tenha sido, é apresentado uma mensagem para o usuário.

Agradeço pela oportunidade de desenvolvimento do projeto.
