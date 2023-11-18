<?php
class PostModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getPostsByPosition($latitude, $longitude)
    {
        $query = "SELECT p.cd_post, p.latitude, p.longitude, p.nm_local, p.endereco,
        p.assunto, p.descricao, p.dt_update, DATE_FORMAT(p.dt_criacao, '%d/%m/%Y %H:%i') dt_criacao, u.id, u.nome
            FROM post p
            INNER JOIN usuarios u ON u.id = p.cd_usuario
            WHERE p.latitude = :latitude
                AND p.longitude = :longitude
            ORDER BY p.dt_criacao DESC";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':latitude', $latitude, PDO::PARAM_STR);
        $statement->bindValue(':longitude', $longitude, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPositions()
    {
        $query = "SELECT DISTINCT p.latitude, p.longitude
            FROM post p";

        //@TODO Trazer apenas posts do bairro do usuário logado

        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertPost($latitude, $longitude, $local, $endereco, $assunto, $descricao, $usuario)
    {
        $query = "INSERT INTO post (latitude, longitude, nm_local, endereco, assunto, descricao, cd_usuario)
                  VALUES (:latitude, :longitude, :nm_local, :endereco, :assunto, :descricao, :cd_usuario)";

        $statement = $this->db->prepare($query);

        $statement->bindParam(':latitude', $latitude, PDO::PARAM_STR);
        $statement->bindParam(':longitude', $longitude, PDO::PARAM_STR);
        $statement->bindParam(':nm_local', $local, PDO::PARAM_STR);
        $statement->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $statement->bindParam(':assunto', $assunto, PDO::PARAM_STR);
        $statement->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $statement->bindParam(':cd_usuario', $usuario, PDO::PARAM_STR);

        return $statement->execute();
    }
}
?>