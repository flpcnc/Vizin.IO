<?php
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <title>Login</title>
</head>

<body>
    <button id="voltar" onclick="location.href='/'"><img id="imgBack" src="img/backArrow.png"></button>
    <h1>Vizin.IO</h1>
    <h2>Login</h2>
    <br>

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($dados['SendLogin'])) {
        $query_usuario = "SELECT id, nome, usuario, senha_usuario, salt
                          FROM usuarios 
                          WHERE usuario = ?";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bind_param("s", $dados['usuario']);
        $result_usuario->execute();
        $result_usuario->store_result();

        if ($result_usuario->num_rows != 0) {
            $result_usuario->bind_result($id, $nome, $usuario, $senha_usuario, $salt);
            $result_usuario->fetch();

            if (password_verify($dados['senha_usuario'] . $salt, $senha_usuario)) {
                $_SESSION['id'] = $id;
                $_SESSION['nome'] = $nome;
                header("Location: menu");
            } else {
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Senha inválida!</p>";
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário inválido!</p>";
        }
        $result_usuario->close();
    }

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="POST" action="">
        <label>Usuário</label>
        <input type="text" name="usuario" placeholder="Digite o usuário"
            value="<?php if (isset($dados['usuario'])) {
                echo $dados['usuario'];
            } ?>"><br><br>

        <label>Senha</label>
        <input type="password" name="senha_usuario" placeholder="Digite a senha"
            value="<?php if (isset($dados['senha_usuario'])) {
                echo $dados['senha_usuario'];
            } ?>"><br><br>
        <br>
        <input type="submit" value="Entrar" name="SendLogin" class="btn">
    </form>

</body>

</html>
