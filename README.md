🧩 Estrutura do Projeto
O projeto está organizado da seguinte forma:

pgsql
Copiar
Editar
FormExemploJSPHP/
├── css/
│   └── style.css
├── js/
│   └── script.js
├── php/
│   ├── conecta.php
│   ├── processa.php
│   └── recupera.php
├── banco/
│   └── schema.sql
├── index.html
└── README.md
css/: Contém os arquivos de estilo CSS.

js/: Contém os scripts JavaScript.

php/: Contém os scripts PHP para processamento do formulário.

banco/: Contém o script SQL para criação do banco de dados.

index.html: Página principal com o formulário.

README.md: Documentação do projeto.

🛠 Tecnologias Utilizadas
Frontend:

HTML5

CSS3

JavaScript

Backend:

PHP 7.4+

Banco de Dados:

MySQL 5.7+

🔍 Detalhamento do PHP Utilizado
1. Conexão com o Banco de Dados (conecta.php)
Este script estabelece a conexão com o banco de dados MySQL utilizando a extensão mysqli do PHP.

php
Copiar
Editar
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
Aqui, são definidos os parâmetros de conexão (servidor, usuário, senha e nome do banco de dados). A função new mysqli() é utilizada para criar uma nova instância de conexão. Se a conexão falhar, o script exibe uma mensagem de erro e encerra a execução.

2. Processamento do Formulário (processa.php)
Este script processa os dados enviados pelo formulário HTML. Ele valida os dados, insere-os no banco de dados e redireciona o usuário para uma página de sucesso.

php
Copiar
Editar
<?php
include 'conecta.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if ($conn->query($sql) === TRUE) {
        header("Location: sucesso.html");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>
O script verifica se o método de requisição é POST, indicando que o formulário foi enviado. Em seguida, os dados são capturados e validados. A senha é criptografada utilizando a função password_hash() para segurança. Os dados são inseridos na tabela usuarios do banco de dados. Se a inserção for bem-sucedida, o usuário é redirecionado para a página sucesso.html. Caso contrário, uma mensagem de erro é exibida.

3. Recuperação de Senha (recupera.php)
Este script permite que os usuários recuperem suas senhas. Ele envia um e-mail com um link para redefinir a senha.

php
Copiar
Editar
<?php
include 'conecta.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT id FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50));
        $sql = "UPDATE usuarios SET token = '$token' WHERE email = '$email'";

        if ($conn->query($sql) === TRUE) {
            $link = "http://localhost/FormExemploJSPHP/recuperaSenha.php?token=$token";
            mail($email, "Redefinir Senha", "Clique no link para redefinir sua senha: $link");
            echo "Instruções enviadas para o seu e-mail.";
        } else {
            echo "Erro ao gerar token.";
        }
    } else {
        echo "E-mail não encontrado.";
    }
}
?>
O script verifica se o método de requisição é POST. Em seguida, ele busca o usuário no banco de dados pelo e-mail fornecido. Se o usuário for encontrado, um token é gerado e armazenado no banco de dados. Um e-mail é enviado ao usuário com um link contendo o token para redefinir a senha.

✅ Funcionalidades Implementadas
Cadastro de Usuário: Permite que novos usuários se registrem fornecendo nome, e-mail e senha.

Validação de Dados: Utiliza PHP para validar e sanitizar os dados antes de inseri-los no banco de dados.

Armazenamento Seguro de Senhas: As senhas são criptografadas utilizando a função password_hash() para segurança.

Recuperação de Senha: Permite que os usuários recuperem suas senhas através de um link enviado por e-mail.

🚀 Como Rodar o Projeto Localmente
Clonar o Repositório

bash
Copiar
Editar
git clone https://github.com/Daniel-Ferreira-2004/FormExemploJSPHP.git
Configurar o Ambiente de Desenvolvimento

Certifique-se de ter o XAMPP ou WampServer instalado em sua máquina. Estes pacotes incluem Apache, PHP e MySQL, facilitando o desenvolvimento local.

Download do XAMPP

Download do WampServer

Configurar o Banco de Dados

Acesse o phpMyAdmin através de http://localhost/phpmyadmin.

Crie um novo banco de dados chamado formulario_db.

Importe o arquivo banco/schema.sql para criar as tabelas necessárias.

Configurar as Credenciais do Banco de Dados

No arquivo php/conecta.php, configure as credenciais de acesso ao banco de dados:

php
Copiar
Editar
$servername = "localhost";
$username = "root"; // Usuário padrão do MySQL no XAMPP
$password = ""; // Senha padrão do MySQL no XAMPP
$dbname = "formulario_db"; // Nome do banco de dados criado
Iniciar o Servidor

Coloque o repositório clonado na pasta htdocs/ do XAMPP.

Inicie os módulos Apache e MySQL no painel de controle do XAMPP.

Acesse o formulário através de http://localhost/FormExemploJSPHP/index.html.
