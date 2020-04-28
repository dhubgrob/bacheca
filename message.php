<?php

require "load-db.php";

session_start();

require "check-auth.php";

require "load-username.php";


var_dump($_GET);
var_dump($_SESSION);

//requête qui récupère les infos sur l'annonce concernée



    $query = 'SELECT * FROM posts WHERE title= :title';
    $sth = $dbh->prepare($query);
    $sth->bindValue(':title', $_GET['ad'], PDO::PARAM_STR);
    $sth->execute();
    $ad = $sth->fetch();
    var_dump($ad);
    



//requête qui injecte les nouvelles données dans 'messages'
if (!empty($_POST)) {
$query = 'INSERT INTO messages (senderid, recipientid, subj, content, adid) VALUES (:senderid, :recipientid, :subj, :content, :adid)';
$sth = $dbh->prepare($query);
$sth->bindValue(':senderid', $_SESSION['userid'], PDO::PARAM_STR);
$sth->bindValue(':recipientid', $_GET['id'], PDO::PARAM_STR);
$sth->bindValue(':subj', htmlspecialchars($_POST['subj']), PDO::PARAM_STR);
$sth->bindValue(':content', htmlspecialchars($_POST['content']), PDO::PARAM_STR);
$sth->bindValue(':adid', $ad['id'], PDO::PARAM_STR);
$sth->execute();

header('Location: http://localhost/projets/bacheca/');
exit;

}

include 'includes/message.phtml';