<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:home.php');
}

unset($_SESSION['id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard with Clickable Cards</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      background-color: gray;
      width: 350px;
      padding: 20px;
      color: white;
    }

    .sidebar i {
      font-size: 24px;
      display: block;
      text-align: center;
      margin-bottom: 10px;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 50px;
    }

    .sidebar p {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 15px;
      border-radius: 8px;
      transition: background 0.3s;
    }

    .sidebar p:hover {
      background-color: red;
    }
    .active{
        background-color: green;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      font-size: 20px;
    }

    .content {
      flex: 1;
      background-color: white;
      padding: 50px 20px;
      display: flex;
      flex-direction: column;
      gap: 40px;
    }

    .card-row {
      display: flex;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .card-link {
      text-decoration: none;
      color: inherit;
    }

    .card {
      background-color: gray;
      width: 200px;
      height: 150px;
      border-radius: 10px;
      text-align: center;
      position: relative;
      color: white;
      transition: transform 0.2s, background-color 0.2s;
    }

    .card:hover {
      background-color: #444;
      transform: scale(1.05);
      cursor: pointer;
    }

    .card i {
      font-size: 50px;
      padding-top: 25px;
    }

    .card h3 {
      position: absolute;
      bottom: 10px;
      width: 100%;
      text-align: center;
      font-size: 20px;
    }
    table{
        width: 60%;
        border-spacing: 0px;
    }
    tr td{
        padding: 20px;
        text-align: center;
    }
  </style>
</head>
<body>
  <div class="container" data-aos="fade-up">
    <!-- Sidebar -->
    <div class="sidebar">
      <i style="font-size: 144px;" class="fas fa-user-circle"></i>
      <h2>Admin</h2>
      <p ><i class="fas fa-tachometer-alt"></i><a  href="home_admin.php">Dashboard</a></p>
      <p class="active"><i class="fas fa-users-cog"></i><a href="manager.php">Manage User</a></p>
      <p><i class="fas fa-plus"></i><a href="create_task.php">Create Task</a></p>
      <p><i class="fas fa-tasks"></i><a href="all_task.php">All Tasks</a></p>
      <p><i class="fas fa-sign-out-alt"></i><a href="Logout_admin.php">Logout</a></p>
    </div>

    
    <div class="content">


    <div style="display: flex;position:relative"><span style="margin-right: 20px;position:absolute">Manage Users :</span><input type="submit" value="Insert" style="cursor:pointer;margin-left:120px;margin-top:-5px;width:80px;background-color: green;color:white;border:none;border-radius:10px;height:30px" onclick="location.href='insert_user.php'"/>
      </div>
<?php

require_once 'My_basse.php';




$po = $conn->prepare('SELECT * FROM employe');
$po->execute();
$res = $po->fetchAll(PDO::FETCH_ASSOC);

?>
<br><br><br><br><br>
<table border="1">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>UserName</th>
        <th>Role</th>
        <th>Date_Adderation</th>
        <th>Email</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
    
      <?php foreach($res as $row){?>
        <tr>
        <td><?= $row['id']?></td>
        <td><?= $row['nom']?></td>
        <td><?= $row['prenom']?></td>
        <td><?= $row['role']?></td>
        <td><?= $row['date_adderation']?></td>
        <td><?= $row['email']?></td>
        <td><?= $row['password']?></td>
        <td>
            <form action="update_user.php" method="post">
                <input type="submit" value="Update" style="background-color: green;border:none;width:70px;height:30px;border-radius:10px;color:white;cursor: pointer;">
                <input type="hidden" name="id" value="<?= $row['id']?>">
            </form><br>
            <form action="delete_user.php" method="post">
                <input onclick="return confirm('Are You Shor Deleted User')" type="submit" value="Delete" style="background-color: red;border:none;width:70px;height:30px;border-radius:10px;color:white;cursor: pointer;">
                <input type="hidden" name="id" value="<?= $row['id']?>">
            </form>
        </td>
    </tr> <?php } ?>
</table>
<?php




?> 

      
      
        
  </div>
  <script>
  AOS.init({
    duration: 1000, 
    once: true,     
  });
</script>
</body>
</html>

