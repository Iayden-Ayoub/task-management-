<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <input type="text" name="nom" placeholder="entrer le nom"><br><br>
    <input type="text" name="prenom" placeholder="entrer le prenom"><br><br>
    <input type="date" name="date" ><br><br>
    <input type="email" name="email" placeholder="entrer l'email"><br><br>
    <input type="text" name="password" placeholder="entrer le mot de passe"><br><br>
    <select name="role">
        <option value="employe">employe</option>
        <option value="stagiaire">stagiaire</option>
    </select><br><br>
    <input type="submit" value="Insert" name="btn">
</form>
</body>
</html>

<?php
session_start();
require_once 'My_basse.php';

if(isset($_POST['btn'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if(empty($nom) || empty($prenom) || empty($date) || empty($email) || empty($password) || empty($role)){
        echo "veuillez remplir tous les champs";
    }else{
        $req = $conn->prepare("INSERT INTO employe VALUES (null,?,?,?,?,?,?)");
        $req->execute(array($nom,$prenom,$date,$email,$password,$role));
        header('location:manager.php');
    }

}

?>