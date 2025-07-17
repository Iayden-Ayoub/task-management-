<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <script src="jquery-3.6.4.min.js"></script>

    <title>Document</title>
</head>
<style>
    *{
        margin: 0;
    }
 body {
  background: linear-gradient(to bottom, #0f2027, #203a43, #2c5364);
  animation: wave 10s linear infinite;
  height: 100vh;
}

@keyframes wave {
  0% { background-position: 0 0; }
  100% { background-position: 0 100%; }
}

    div{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: center;
    }
    form{
        background-color: gray;
        width: 400px;
        height: 300px;
        border-radius: 20px;
        padding: 20px;
        margin-top: -30px;
        box-shadow: 0 0 7px 5px yellow;
    }
    input{
        text-align: center;
        height: 40px;
        width: 270px;
        border-radius: 10px;
        border: none;
        outline: none;
    }
    .sub:hover{
        transform: scale(0.9);
    }
</style>
<body>
    <div>
        <form action="" method="post">
        <h1 style="margin-top: -100px;padding:30px;color:white">Bienvenue Admin</h1>
        <b style="font-size: 24px;"><label>Email </label></b><i style="margin-top: 1px;color:white;margin-left:8px;position:absolute" class="material-icons">&#xe0be;</i><br><br>
        <input type="email" name="email" placeholder="Enter your email " required><br><br>
        <b style="font-size: 24px;"><label>Password</label></b><i style="margin-top: 1px;color:white;margin-left:8px;" class='fas fa-eye-slash' style='font-size:26px'></i><br><br>
        <input type="password" name="password" placeholder="Enter your password" required><br><p id="p"></p><br><br>
        <input class="sub" style="color: white;background-color:#0f2027;cursor:pointer" type="submit" name="btn" value="Se Connecter"><br><br>
    </form></div>
</body>
</html>
<?php

require_once 'My_basse.php';
if(isset($_POST['btn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $po = $conn->prepare('SELECT * FROM admins WHERE email = ? AND passwordd = ?');
    $po->execute([$email,$password]);
    $res = $po->rowCount();
    if($res == 1){
        session_start();
        $_SESSION['admin'] = $po->fetch(PDO::FETCH_ASSOC);
        header('location:home_admin.php');
    }else{
        ?><script>$("#p").html('Email ou mot de passe incorrecte !').css({'color':'red','font-size':'18px','margin-top':'5px'})</script><?php
    }
}



?>