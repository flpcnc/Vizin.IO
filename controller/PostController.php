<?php
class PostController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    { 
        include_once('view/post.php');
    }

    public function pins() {
        header('Content-Type: application/json');

        $posts = $this->model->getPositions();
        echo json_encode($posts);
    }

    public function posts() {
        header('Content-Type: application/json');

        $posts = $this->model->getPostsByPosition($_GET['latitude'], $_GET['longitude']);
        echo json_encode($posts);
    }

    public function add()
    {
        $this->model->insertPost($_POST['latitude'], $_POST['longitude'], $_POST['local'], $_POST['endereco'], $_POST['assunto'], $_POST['descricao'], $_SESSION['id']);
        //@TODO Tratar erros
    }
}
?>