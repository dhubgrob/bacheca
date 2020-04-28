<?php

require "load-db.php";

session_start();

require "check-auth.php";

require "load-username.php";


//requête qui injecte les nouvelles données dans 'messages'
if (!empty($_POST)) {
    $query = 'INSERT INTO messages (senderid, recipientid, subj, content, adid) VALUES (:senderid, :recipientid, :subj, :content, :adid)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(':senderid', $_SESSION['userid'], PDO::PARAM_INT);
    $sth->bindValue(':recipientid', $_POST['recipientid'], PDO::PARAM_INT);
    $sth->bindValue(':subj', htmlspecialchars($_POST['subj']), PDO::PARAM_STR);
    $sth->bindValue(':content', htmlspecialchars($_POST['content']), PDO::PARAM_STR);
    $sth->bindValue(':adid', $_POST['adid'], PDO::PARAM_INT);
    $sth->execute();
    
    //header('Location: http://localhost/projets/bacheca/');
    //exit;
    
    }