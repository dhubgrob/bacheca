<?php

require "load-db.php";

session_start();

var_dump($_POST);


    // gestion des upload d'images
    if (array_key_exists('monFichierBis', $_FILES)) {
        if ($_FILES['monFichierBis']['error'] == 0) {
            if (in_array(mime_content_type($_FILES['monFichierBis']['tmp_name']), ['image/png', 'image/jpeg'])) {
                if ($_FILES['monFichierBis']['size'] <= 3000000) {
                    $urlImageBis = uniqid() . "." . pathinfo($_FILES['monFichierBis']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['monFichierBis']['tmp_name'], 'uploads/' . $urlImageBis);

                    $query = 'INSERT INTO images (file_name, postid) VALUES(:file_name, :postid)';
                    $sth = $dbh->prepare($query);
                    $sth->bindValue(':file_name', $urlImageBis, PDO::PARAM_STR);
                    $sth->bindValue(':postid', $_POST['hiddenid2'], PDO::PARAM_INT);
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
            echo 'Le fichier n\'a pas pu être récupéré…';
        }
    }
