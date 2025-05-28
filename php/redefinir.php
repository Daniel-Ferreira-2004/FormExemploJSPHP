<?php
// Usa as classes do PHPMailer que estão nos arquivos externos
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclui os arquivos do PHPMailer necessários para enviar o e-mail
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Pega o e-mail informado no formulário via POST. Se não vier nada, usa uma string vazia.
$email_do_usuario = $_POST['email'] ?? '';

// Gera uma nova senha aleatória com 8 caracteres (letras maiúsculas, minúsculas e números)
$nova_senha = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

// Criptografa a nova senha para armazenar no banco de dados (por segurança)
$senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);

// Inclui o arquivo com os dados de conexão com o banco de dados
include_once('config.php');

// Verifica se o e-mail existe no banco de dados
$stmt = $conexao->prepare("SELECT id FROM formulariodaniel WHERE email = ?");
$stmt->bind_param('s', $email_do_usuario); // 's' = string
$stmt->execute();
$stmt->store_result(); // Necessário para verificar a quantidade de resultados retornados

// Se não encontrou o e-mail, encerra o script
if ($stmt->num_rows == 0) {
    echo "E-mail não cadastrado.";
    $stmt->close();
    $conexao->close();
    exit;
}
$stmt->close(); // Fecha a primeira consulta

// Atualiza a senha do usuário com a nova senha criptografada
$stmt = $conexao->prepare("UPDATE formulariodaniel SET senha = ? WHERE email = ?");
$stmt->bind_param('ss', $senha_criptografada, $email_do_usuario);

if (!$stmt->execute()) {
    die('Erro ao atualizar senha no banco.');
}

$stmt->close();
$conexao->close(); // Fecha a conexão com o banco

// Começa a configuração do envio de e-mail
$mail = new PHPMailer(true); // true ativa o modo "exceptions" para capturar erros

try {
    // Configuração do servidor SMTP do Gmail
    $mail->isSMTP(); // Define o tipo de envio como SMTP
    $mail->Host = 'smtp.gmail.com'; // Servidor de e-mail
    $mail->SMTPAuth = true; // Ativa autenticação
    $mail->Username = 'danikferreira69@gmail.com'; // Seu e-mail remetente
    $mail->Password = 'vbytqonrbkdqfybb'; // Senha de aplicativo do Gmail
    $mail->SMTPSecure = 'tls'; // Tipo de segurança
    $mail->Port = 587; // Porta padrão para TLS

    // Define o remetente e o destinatário
    $mail->setFrom('danikferreira69@gmail.com', 'Sistema de Recuperação de Senha');
    $mail->addAddress($email_do_usuario); // Envia para o e-mail informado no formulário

    // Define o conteúdo do e-mail
    $mail->isHTML(true); // Habilita conteúdo HTML
    $mail->Subject = 'Nova Senha do Conecta Local'; // Assunto do e-mail
    $mail->Body = "Sua nova senha é: <b>$nova_senha</b>"; // Corpo em HTML
    $mail->AltBody = "Sua nova senha é: $nova_senha"; // Corpo alternativo para leitores que não suportam HTML

    // Envia o e-mail
    $mail->send();
    echo "<script>alert('Nova Senha Enviada para seu Email (verificar Spam)'); window.location.href = '../form.html';</script>";
} catch (Exception $e) {
    // Caso ocorra erro ao enviar
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}
?>