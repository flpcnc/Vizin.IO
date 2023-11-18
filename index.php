<?php
    session_start();

    require_once('conexao.php');
    require_once('controller/PostController.php');
    require_once('controller/LogoutController.php');
    require_once('model/PostModel.php');

    $routes = array(
        '' => 'inicial',
        'inicial' => 'inicial',
        'menu' => 'menu',
        'login' => 'login',
        'nova-conta' => 'novaConta',
        'post' => (new PostController(new PostModel($conn))),
        'logout' => (new LogoutController()),
    );

    $uri = explode('/', preg_replace('/\?.*/', '', ltrim($_SERVER['REQUEST_URI'], '/')));

    if (array_key_exists($uri[0], $routes)) {
        //@TODO: Melhorar isso
        if($uri[0] && $uri[0] != 'login' && $uri[0] != 'nova-conta' && !isset($_SESSION['id'])) {
            header("Location: /");
            exit;
        }

        //@TODO: Corrigir esse lixo aqui -> só fiz MVC pro Post
        if($uri[0] == 'post' || $uri[0] == 'logout') {
            $method = isset($uri[1]) ? $uri[1] : 'index';
            $routes[$uri[0]]->{$method}();
        } else
            include $routes[$uri[0]].'.php';
        exit();
    }
    
    die('Fingir que aqui tem uma tela bonita te dizendo que a página não existe');
 ?>