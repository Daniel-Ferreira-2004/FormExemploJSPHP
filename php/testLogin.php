<?php
if (isset($_POST["submit"]) && !empty($_POST['email']) && !empty($_POST['passwords'])) {

    include_once('config.php');

    // Captura e sanitiza os dados
    $email = strtolower(trim($_POST['email']));
    $senha = $_POST['passwords'];

    // Prepara a consulta para verificar se o e-mail existe
    $stmt = $conexao->prepare("SELECT senha FROM formulariodaniel WHERE LOWER(TRIM(email)) = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Usa store_result() ao invés de get_result()
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        // Liga a variável ao resultado da coluna "senha"
        $stmt->bind_result($senhaHash);
        $stmt->fetch();

        // Verifica se a senha informada bate com o hash no banco
        if (password_verify($senha, $senhaHash)) {
            echo "<script>alert('Login realizado com sucesso!'); window.location.href = 'sistema.php';</script>";
        } else {
            echo "<script>alert('Senha inválida.'); window.location.href = '../form.html';</script>";
        }
    } else {
        echo "<script>alert('Email não cadastrado.'); window.location.href = '../form.html';</script>";
    }

    // Fecha a consulta e a conexão
    $stmt->close();
    $conexao->close();

} else {
    // Redireciona se os campos obrigatórios não estiverem preenchidos
    header("Location: ../form.html");
    exit;
}
?>

