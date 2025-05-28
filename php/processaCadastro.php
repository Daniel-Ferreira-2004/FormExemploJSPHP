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
    include_once('config.php');

    // Verifica se o método da requisição foi POST
    // Isso garante que os dados vieram de um formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Captura os valores enviados pelo formulário e guarda em variáveis
        $nome = $_POST['name'];         // Nome do usuário
        $email = $_POST['email'];       // Email do usuário
        $senha = password_hash($_POST['passwords'], PASSWORD_DEFAULT); // Criptografa a Senha do usuário
        $fullname = $_POST['Fullname']; // Sobrenome do usuário
        $telefone = $_POST['tel'];      // Telefone do usuário
        $endereco = $_POST['adress'];   // Endereço do usuário

        // Verificando se o e-mail já existe na tabela 'formulariodaniel'
        $verifica = $conexao->prepare("SELECT id FROM formulariodaniel WHERE email = ?");
        $verifica->bind_param("s", $email);
        $verifica->execute();
        $verifica->store_result(); // Armazena o resultado para poder contar as linhas

        if ($verifica->num_rows > 0) {
            // Já existe um registro com esse e-mail
            echo "<script>alert('Este e-mail já está cadastrado!');  window.location.href = '../form.html';</script>";
        } else {
            // Prepara uma declaração SQL segura com "?" como marcadores de posição
            // Isso evita SQL Injection
            $stmt = $conexao->prepare(
                "INSERT INTO formulariodaniel (Nome, sobrenome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?, ?)"
            );

            // Substitui os "?" pelos valores informados acima
            // 'ssssis' indica o tipo de cada valor:
            // s = string (texto), i = integer (número inteiro)
            $stmt->bind_param("ssssss", $nome, $fullname, $email, $senha, $telefone, $endereco);

            // Executa a consulta SQL com os dados inseridos
            if ($stmt->execute()) {
                echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href = '../form.html';</script>";
            } else {
                // Mostra o erro caso a execução falhe
                echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "'); window.history.back();</script>";
            }

            // Fecha a preparação da consulta para liberar recursos
            $stmt->close();

            // Fecha a conexão com o banco de dados
            $conexao->close();
        }
    }
}
?>