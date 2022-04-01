<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Basics</title>
</head>
<body>

<?php

// CONFIGURATION CONNECTION PDO

require 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

// PREPARATION REQUETE D'INSERTION

$firstname = trim($_POST['firstname']); 
$lastname = trim($_POST['lastname']);

$query = 'INSERT INTO friends (firstname, lastname) VALUES (:firstname, :lastname)';

$statement = $pdo->prepare($query);
$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
$statement->execute();
$statement->fetchAll(PDO::FETCH_ASSOC);

echo '<br/><br/>';

echo '<h1>Friends</h1>
<form action="" method="post">
    <label for="firstname">Firstname: </label>
    <input type="texte" name="firstname" placeholder="Add a name">
    <br/><br/>
    <label for="lastname">Lastname: </label>
    <input type="texte" name="lastname" placeholder="Add a lastname">
    <br/><br/>
    <button href="index.php" type="submit" name="submit">Add a Friend</button>
</form><br/><br/>';

//AFFICHAGE DU NOUVEAU 'FRIEND' SOUMIS VIA FORMULAIRE

var_dump($_POST);
echo '<br/><br/>';

// LISTE DES 'FRIENDS' ENREGISTRES DANS LA BASE DE DONNEES

$query = 'SELECT * FROM friends';
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);
print_r($friends);

?>

</body>
</html>
