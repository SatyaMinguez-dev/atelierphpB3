
<?php

function getArticleById(PDO $pdo, int $id):array|bool
{
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getArticles(PDO $pdo, int $limit = null, int $page = null):array|bool
{

    /*
        @todo faire la requête de récupération des articles
        La requête sera différente selon les paramètres passés, commencer par le BASE de base
    */
    $query = $pdo ->prepare("SELECT * FROM articles");

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getTotalArticles(PDO $pdo):int|bool
{
    /*
        @todo récupérer le nombre total d'article (avec COUNT) c'est GOOD
    */
    $query = $pdo ->prepare("SELECT COUNT(*) as total FROM articles");

    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function saveArticle(PDO $pdo, string $title, string $content, string|null $image, int $category_id, int $id = null):bool 
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO articles (title, content, image, category_id) VALUES (:title, :content, :image, :category_id)");
    } else {
        $query = $pdo->prepare("UPDATE articles SET title = :title, content = :content, image = :image, category_id = :category_id WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':content', $content, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    $query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    
    return $query->execute(); 


    // @todo on bind toutes les valeurs communes
   

   


}

function deleteArticle(PDO $pdo, int $id):bool
{
    $query = $pdo->prepare("DELETE FROM articles WHERE id = :id"); //requete de suppression
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();

    //compte combien d'enregistrements correspondent aux critères spécifiés dans la requête
    if ($query->rowCount() > 0) { // vérifie si le nombre de lignes retourné par la requête est supérieur à zéro
        return true;
    } else {
        return false;
    }

}