<?php

require "load-db.php";



    session_start();


    if(!empty($_SESSION)){
    // requête qui récupère le username du membre connecté
    $query = 'SELECT username FROM users WHERE id= :iduser';
    $sth = $dbh->prepare($query);
    $sth->bindValue(':iduser', trim($_SESSION['userid']), PDO::PARAM_STR);
    $sth->execute();
    $usernameSession = $sth->fetch();
    }

//	Si l'utilisateur n'est pas authentifié
if (!array_key_exists('userid', $_SESSION)) {
    //	Redirection vers la page d'accueil
    header('Location: index.php');
    exit;
}

if (!empty($_POST)) {
    //upload de 3 images
    if (array_key_exists('monFichier1', $_FILES) || array_key_exists('monFichier2', $_FILES) || array_key_exists('monFichier3', $_FILES)) {
        if ($_FILES['monFichier1']['error'] == 0 || $_FILES['monFichier2']['error'] == 0 || $_FILES['monFichier3']['error'] == 0) {
            if (in_array(mime_content_type($_FILES['monFichier1']['tmp_name']), ['image/png', 'image/jpeg']) || in_array(mime_content_type($_FILES['monFichier2']['tmp_name']), ['image/png', 'image/jpeg']) || in_array(mime_content_type($_FILES['monFichier3']['tmp_name']), ['image/png', 'image/jpeg'])) {
                if ($_FILES['monFichier1']['size'] <= 3000000 || $_FILES['monFichier2']['size'] <= 3000000 || $_FILES['monFichier3']['size'] <= 3000000) {
                    $urlImage1 = uniqid() . "." . pathinfo($_FILES['monFichier1']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['monFichier1']['tmp_name'], 'uploads/' . $urlImage1);

                    $urlImage2 = uniqid() . "." . pathinfo($_FILES['monFichier2']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['monFichier2']['tmp_name'], 'uploads/' . $urlImage2);

                    $urlImage3 = uniqid() . "." . pathinfo($_FILES['monFichier3']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['monFichier3']['tmp_name'], 'uploads/' . $urlImage3);

                    

                    $query = 'INSERT INTO posts (title, price, content, userid, featureImg) VALUES (:title, :price, :content, :userid, :featureImg)';
                    $sth = $dbh->prepare($query);
                    $sth->bindValue(':title', htmlspecialchars($_POST['product']), PDO::PARAM_STR);
                    $sth->bindValue(':price', htmlspecialchars($_POST['price']), PDO::PARAM_STR);
                    $sth->bindValue(':content', htmlspecialchars($_POST['content']), PDO::PARAM_STR);
                    $sth->bindValue(':userid', $_SESSION['userid'], PDO::PARAM_STR);
                    $sth->bindValue(':featureImg', null, PDO::PARAM_NULL);
                    $sth->execute();
                    $idArticle = $dbh->lastInsertId();

                    if(strpos($urlImage1, '.jpg') OR strpos($urlImage1, '.png')) { 

                    $query = 'UPDATE posts SET featureImg=:feature WHERE id=:postid';
                    $sth = $dbh->prepare($query);
                    $sth->bindValue(':feature', $urlImage1, PDO::PARAM_STR);
                    $sth->bindValue(':postid', $idArticle, PDO::PARAM_STR);
                    $sth->execute();
                    }

                    if(strpos($urlImage2, '.jpg') OR strpos($urlImage2, '.png')) {
                    $query = 'INSERT INTO images (file_name, postid) VALUES(:file_name, :postid)';
                    $sth = $dbh->prepare($query);
                    $sth->bindValue(':file_name', $urlImage2, PDO::PARAM_STR);
                    $sth->bindValue(':postid', $idArticle, PDO::PARAM_STR);
                    $sth->execute();
                    }

                    if(strpos($urlImage3, '.jpg') OR strpos($urlImage3, '.png')) {

                    $query = 'INSERT INTO images (file_name, postid) VALUES(:file_name, :postid)';
                    $sth = $dbh->prepare($query);
                    $sth->bindValue(':file_name', $urlImage3, PDO::PARAM_STR);
                    $sth->bindValue(':postid', $idArticle, PDO::PARAM_STR);
                    $sth->execute();
                    }

                    header('Location: http://localhost/projets/bacheca/dashboard.php');
                    exit;



                    
                } else {
                    echo 'Le fichier est trop volumineux…';
                }
            }


    }


/*
    // gestion des upload de 1 image
    elseif (array_key_exists('monFichier1', $_FILES)) {
        if ($_FILES['monFichier1']['error'] == 0) {
            if (in_array(mime_content_type($_FILES['monFichier1']['tmp_name']), ['image/png', 'image/jpeg'])) {
                if ($_FILES['monFichier1']['size'] <= 3000000) {
                    $urlImage = uniqid() . "." . pathinfo($_FILES['monFichier1']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['monFichier1']['tmp_name'], 'uploads/' . $urlImage);


                    $query = 'SELECT * FROM posts INNER JOIN images ON posts.id = images.postid';
                    $sth = $dbh->prepare($query);
                    $sth->execute();
                    $imagesAndArticles = $sth->fetchAll();
                    var_dump($imagesAndArticles);

                    $query = 'SELECT * FROM posts';
                    $sth = $dbh->prepare($query);
                    $sth->execute();
                    $posts = $sth->fetchAll();
                    

                    $query = 'INSERT INTO posts (title, price, content, userid) VALUES (:title, :price, :content, :userid)';
                    $sth = $dbh->prepare($query);
                    $sth->bindValue(':title', htmlspecialchars($_POST['product']), PDO::PARAM_STR);
                    $sth->bindValue(':price', htmlspecialchars($_POST['price']), PDO::PARAM_STR);
                    $sth->bindValue(':content', htmlspecialchars($_POST['content']), PDO::PARAM_STR);
                    $sth->bindValue(':userid', $_SESSION['userid'], PDO::PARAM_STR);
                    $sth->execute();
                    $idArticle = $dbh->lastInsertId();

                    $query = 'INSERT INTO images (file_name, postid) VALUES(:file_name, :postid)';
                    $sth = $dbh->prepare($query);
                    $sth->bindValue(':file_name', $urlImage, PDO::PARAM_STR);
                    $sth->bindValue(':postid', $idArticle, PDO::PARAM_STR);
                    $sth->execute();

                    header('Location: http://localhost/projets/bacheca/dashboard.php');
                    exit;



                    
                } else {
                    echo 'Le fichier est trop volumineux…';
                }
            } else {
                echo 'Le type mime du fichier est incorrect…';
            }
        } else {
           echo 'le fichier n\'a pas pu etre chargé';
        }
    }
}}
*/