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
        $query_usuario = "SELECT *
                          FROM usuarios 
                          WHERE usuario = '" . $dados['usuario'] . "' 
                            ";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->execute();


        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch();
            if (password_verify($dados['senha_usuario'] . $row_usuario['salt'], $row_usuario['senha_usuario'])) {
                $_SESSION['id'] = $row_usuario['id'];
                $_SESSION['nome'] = $row_usuario['nome'];
                header("Location: menu");
            } else {
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Senha inválida!</p>";
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário inválido!</p>";
        }

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
        <input type="submit" value="Entar" name="SendLogin" class="btn">
    </form>


</body>

</html>