<?php
$host = 'localhost';
$usuario = 'root';
$senha = 'root';
$banco = 'meu_banco';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Verifica se a variável $conn está definida e não é nula
if (!isset($conn) || $conn === null) {
    $conn = $conexao;
} else {
    die("A conexão com o banco de dados não foi estabelecida corretamente.");
}
