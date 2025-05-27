<?php
// Verifica se o botão 'submit' foi clicado no formulário
if (isset($_POST['submit'])) {

    // As linhas abaixo eram usadas para teste, imprimindo os dados recebidos do formulário
    // Você pode descomentar para verificar os valores enviados
    // print_r('Nome: ' . $_POST['name']);
    // print_r('<br>');
    // print_r('Email: '. $_POST['email']);
    // print_r('<br>');
    // print_r('Senha: '. $_POST['password']);
    // print_r('<br>');
    // print_r('Sobre Nome: '. $_POST['Fullname']);
    // print_r('<br>');
    // print_r('Telefone: '. $_POST['tel']);
    // print_r('<br>');
    // print_r('Endereço: '. $_POST['adress']);

    // Inclui o arquivo que conecta com o banco de dados
    include_once('php/config.php');

    // Verifica se o método da requisição foi POST
    // Isso garante que os dados vieram de um formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Captura os valores enviados pelo formulário e guarda em variáveis
        $nome = $_POST['name'];         // Nome do usuário
        $email = $_POST['email'];       // Email do usuário
        $senha = $_POST['passwords'];    // Senha do usuário
        $fullname = $_POST['Fullname']; // Sobrenome do usuário
        $telefone = $_POST['tel'];      // Telefone do usuário
        $endereco = $_POST['adress'];   // Endereço do usuário

        // Prepara uma declaração SQL segura com "?" como marcadores de posição
        // Isso evita SQL Injection
        $stmt = $conexao->prepare(
            "INSERT INTO formulariodaniel (Nome, sobrenome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?, ?)"
        );

        // Substitui os "?" pelos valores informados acima
        // 'ssssis' indica o tipo de cada valor:
        // s = string (texto), i = integer (número inteiro)
        $stmt->bind_param("ssssis", $nome, $fullname, $email, $senha, $telefone, $endereco);

        // Executa a consulta SQL com os dados inseridos
        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            // Mostra o erro caso a execução falhe
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        // Fecha a preparação da consulta para liberar recursos
        $stmt->close();

        // Fecha a conexão com o banco de dados
        $conexao->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/form.css">
    <script src="https://kit.fontawesome.com/057ab5b72f.js" crossorigin="anonymous"></script>
    <script src="JS/form.js" defer></script>
    <title>form</title>
</head>

<body>
    <main>
        <section>
            <!--Começo do Form elemento pai-->
            <div class="Form" id="FormID">

                <!--Começo do formBox onde vai ficar o formulario de Login-->
                <div class="formBox Login">
                    <h2>Entrar com</h2>

                    <!--Começo do formlogo onde vai ficar as Logos-->
                    <div class="formlogo">
                        <a href="" class="social-icon">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fa-brands fa-google"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                    <!--Fechamento do formlogo onde vai ficar as Logos-->

                    <p>ou utilize sua conta</p>

                    <!--Começo do Formulario Login-->
                    <form action="php/testLogin.php" method="post">
                        <input type="email" name="email" id="email" class="email formInput" placeholder="Email"
                            required>

                        <input type="password" name="passwords" id="passwords" class="passwords formInput"
                            placeholder="Senha" required>


<<<<<<< HEAD
                        <a href="#" class="esqueceuSenha">Esqueceu sua senha?</a>
=======
                        <a href="#">Esqueceu sua senha?</a>
>>>>>>> 7263acf61b27bb70d3a60df5f8cf1942772bb0d4


                        <button type="submit" name="submit" id="submit" class="btn">Enviar</button>
                    </form>
                    <!--Fechamento do Formulario Login-->
                    <!--Começo do Registra-se para Mobile-->
                    <p class="mobile-text">Não tem conta? <a id="btnOverlayLoginMobile">Registre-se</a>
                    </p>
                    <!--Fechamento do Registra-se para Mobile-->

                </div>
                <!--Fechamento do formBox Login-->

                <!--Começo do formBox onde vai ficar o formulario de Registro-->
                <div class="formBox Register">
                    <h2>Criar Conta</h2>

                    <!--Começo do formlogo onde vai ficar as Logos-->
                    <div class="formlogo">
                        <a href="" class="social-icon">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fa-brands fa-google"></i>
                        </a>
                        <a href="" class="social-icon">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                    <!--Fechamento do formlogo onde vai ficar as Logos-->

                    <p>ou cadastre seu email</p>

                    <!--Começo do Formulario Login-->
                    <form action="form.php" method="post">
                        <div class="SeparaForm"> <!--SeparaForm usado para separar os formulario de 2 em 2-->
                            <input type="name" name="name" id="name" class="name formInput" placeholder="Nome" required>

                            <input type="name" name="Fullname" id="Fullname" class="Fullname formInput"
                                placeholder="Sobrenome" required>
                        </div>

                        <div class="SeparaForm">
                            <input type="email" name="email" id="email" class="email formInput" placeholder="Email"
                                required>

                            <input type="password" name="passwords" id="passwords" class="passwords formInput"
                                placeholder="Senha" required>
                        </div>

                        <input type="tel" name="tel" id="tel" class="tel formInput"
                            placeholder="Numero de Telefone (11) *_****_****" required>

                        <input type="text" name="adress" id="adress" class="adress formInput" placeholder="Endereço"
                            required>

                        <button type="submit" name="submit" id="submit" class="btn">Enviar</button>

                        <h1>x</h1>
                    </form>
                    <!--Fechamento do Formulario Login-->

                    <!--Começo do Login para Mobile-->
                    <p class="mobile-text">Já tem conta? <a id="btnOverlayRegisterMobile">Faça o login</a>
                    </p>
                    <!--Fechamento do Login para Mobile-->
                </div>
                <!--Fechamento do formBox Registro-->

                <!--Começo do overlayContainer onde vai ficar o Overlay dos formularios-->
                <div class="overlayContainer">

                    <!--Começo do overlayContent Login, o conteudo do Overlay-->
                    <div class="overlayContent">
                        <h2>Já tem conta?</h2>
                        <p>Para fazer login entre aqui</p>

                        <!--Começo do btnOverlay, o botão onde será acrescentado o event do JavaScritp para movimentação do Overlay-->
                        <button class="btn btnOverlay" id="btnOverlayLogin">Entrar</button>
                        <!--Fechamento do btnOverlay-->

                    </div>
                    <!--Fechamento do overlayContent-->

                    <!--Começo do overlayContent Cadastre-se, o conteudo do Overlay-->
                    <div class="overlayContent">
                        <h2>Não tem conta ?</h2>
                        <p>Cadastre-se aqui</p>

                        <!--Começo do btnOverlay, o botão onde será acrescentado o event do JavaScritp para movimentação do Overlay-->
                        <button class="btn btnOverlay" id="btnOverlayRegister">Cadastrar</button>
                        <!--Fechamento do btnOverlay-->
                    </div>
                    <!--Fechamento do overlayContent Cadastre-se-->

                </div>
                <!--Fechamento do overlayContainer-->

            </div>
            <!--Fechamento do Form elemento pai-->

        </section>
    </main>
</body>

</html>