<?php

//print_r($_REQUEST);
if (isset($_POST["submit"]) && !empty($_POST['email']) && !empty($_POST['passwords'])) {
    //Acessa o sistema
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['passwords'];

    $sql = "SELECT * FROM formulariodaniel WHERE email = '$email' AND senha = '$senha'";

    $result = $conexao->query($sql);

    //print ($sql);
    //print_r($result);

    if (mysqli_num_rows($result) < 1) {
        //não existe usuario no Banco de Dados
        header("location: ../form.php");
    } else {
        //existe usuario no Banco de Dados
        print_r('Existe');
    }

} else {
    header("location:../form.php");
    exit;
}
?>