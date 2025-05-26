<?php

// Aqui a gente verifica se o botão "submit" foi apertado e se os campos de email e senha foram preenchidos
if (isset($_POST["submit"]) && !empty($_POST['email']) && !empty($_POST['passwords'])) {

    // A gente chama outro arquivo que liga o nosso site ao banco de dados (tipo um caderno onde guardamos os cadastros)
    include_once('config.php');

    // Pegamos o que a pessoa escreveu no campo de email e guardamos numa caixinha chamada $email
    $email = $_POST['email'];

    // E também pegamos o que ela escreveu na senha e guardamos na caixinha $senha
    $senha = $_POST['passwords'];

    // Aqui perguntamos ao banco de dados: “Tem alguém cadastrado com esse email e essa senha?”
    $sql = "SELECT * FROM formulariodaniel WHERE email = '$email' AND senha = '$senha'";

    // Mandamos essa pergunta para o banco de dados e ele nos dá a resposta (mesmo que seja vazia)
    $result = $conexao->query($sql);

    // Se a resposta NÃO tiver nenhuma linha (ou seja, ninguém com esse email e senha)
    if (mysqli_num_rows($result) < 1) {
        // Então mandamos o usuário de volta para o formulário
        header("location: ../form.php");
    } else {
        // Mas se achamos alguém com esse email e senha...
        // Mostramos uma mensagem dizendo que a pessoa existe (login certo!)
        print_r('Existe');
    }

} else {
    // Se a pessoa tentou acessar essa página sem preencher os campos...
    // Mandamos ela de volta para o formulário também!
    header("location:../form.php");
    exit;
}
?>
