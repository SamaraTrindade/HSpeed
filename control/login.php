<?php

session_start();
include '../classes/Connection.php';

$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = md5($_POST['senha']);

$stmt = $conn->prepare("SELECT * FROM responsavel WHERE CPF = :cpf AND Senha = :senha");

$stmt->execute(array(
    ':cpf'   => $cpf,
    ':senha' => $senha
));

if ($stmt->rowCount() == 1) {
    // LOGADO
    $user = $stmt->fetch();
    $_SESSION['ID'] = $user['ResponsavelID'];
    $_SESSION['Nome'] = $user['Nome'];
    $_SESSION['CPF'] = $user['CPF'];
    $_SESSION['CEP'] = $user['CEP'];
    $_SESSION['Localizacao'] = $user['Localizacao'];
    echo "1";
} else {
    // ERRO (DESTROI SESSAO)
    session_destroy();
    echo "0";
}
