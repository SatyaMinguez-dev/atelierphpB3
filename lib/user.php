<?php

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password, $role = "user")
{
    /*
        @todo faire la requête d'insertion d'utilisateur et retourner $query->execute();
        Attention faire une requête préparer et à binder les paramètres
    */
    $query = $pdo->prepare("INSERT INTO users(first_name,last_name,email,password) VALUES (:first_name,:last_name,:email,:password)");
    //requete d'insertion et prepare() pour des questions de sécurité
    $query -> bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $query -> bindValue(':last_name', $last_name, PDO::PARAM_STR); //changement de FETCH_ASSOC en PARAM_STR car last_name est un string
    $query -> bindValue(':email', $email, PDO::PARAM_STR);
    $query -> bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);

    $query->execute();

}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    /*
        @todo faire une requête qui récupère l'utilisateur par email et stocker le résultat dans user
        Attention faire une requête préparer et à binder les paramètres
    */

    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindValue(':email', $email, PDO::PARAM_STR);  
    $query->execute();
    
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
       return $user;
    }
    else
    {
        return false;
    }
    
        
    /*
        @todo Si on a un utilisateur et que le mot de passe correspond (voir fonction  native password_verify)
              alors on retourne $user
              sinon on retourne false
    */


}
