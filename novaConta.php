<?php
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Cadastro</title>
</head>

<body>
    <button id="voltar" onclick="location.href='/'"><img id="imgBack" src="img/backArrow.png"></button>
    <h1>Bem vindo (a)!</h1>
    <h3>Crie uma conta no app</h3>
    <br>

    <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ($dados) {

        $nome = $dados['nome'];
        $email = $dados['email'];
        $usuario = $dados['usuario'];
        $senha_usuario = $dados['senha_usuario'];

        if (
            !empty($dados['Cadastrar'])
            and !empty($dados['usuario'])
            and !empty($dados['senha_usuario'])
        ) {

            $query_login = "SELECT *
                        FROM usuarios 
                        WHERE usuario ='" . $dados['usuario'] . "'";

            $result_login = $conn->prepare($query_login);
            $result_login->execute();

            if ($result_login->rowCount() != 0) {
                $_SESSION['msg'] = "<p style='color: #ff0000'>Este usuário já está em uso!</p>";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['msg'] = "<p style='color: #ff0000'>Formato de e-mail inválido</p>";
            } else {

                $salt = bin2hex(random_bytes(16));
                $hashedPass = password_hash($senha_usuario . $salt, PASSWORD_DEFAULT);

                $query_novo_usuario = "INSERT INTO usuarios (nome, email, usuario, senha_usuario, salt) 
                               VALUES ('$nome', '$email', '$usuario', '$hashedPass', '$salt')";

                $result_novo_usuario = $conn->prepare($query_novo_usuario);
                $result_novo_usuario->execute();

                if (true) {
                    echo '<script type="text/javascript">
                        alert("Usuário criado com sucesso" ); 
                        location= "/"; 
                     </script>';
                }
            }

        } else if (
            !empty($dados['Cadastrar'])
            and empty($dados['usuario']) || empty($dados['senha_usuario'])
        ) {
            $_SESSION['msg'] = "<p style='color: #ff0000'>Usuário ou senha não preenchidos!</p> 
                            <p style='color: #ff0000'> Eles são campos obigatórios, por favor preencha-os.</p>";

        }

    }


    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    ?>

    <form method="POST" action="">

        <input type="text" name="nome" placeholder="nome"
            value="<?php if (isset($dados['nome'])) {
                echo $dados['nome'];
            } ?>"><br><br>

        <input type="text" name="email" placeholder="email"
            value="<?php if (isset($dados['email'])) {
                echo $dados['email'];
            } ?>"><br><br>

        <input type="text" name="usuario" placeholder="usuário"
            value="<?php if (isset($dados['usuario'])) {
                echo $dados['usuario'];
            } ?>"><br><br>

        <input type="password" name="senha_usuario" placeholder="senha"
            value="<?php if (isset($dados['senha_usuario'])) {
                echo $dados['senha_usuario'];
            } ?>"><br><br>
        <br>
        <input type="submit" value="Criar conta" name="Cadastrar" class="btn">
    </form>


</body>

</html>