<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:home.php');
}

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
  <script src="jquery-3.6.4.min.js"></script>
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
      margin-top: 50px;
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
      background-color: #111;
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
    .nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 50px;
  background-color: #333; 
  color: white; 
  padding: 0 20px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); 
   z-index: 1000;
}

.x {
      position: relative;
      margin-right: 10px;
      font-size: 24px;
      color: yellow;
      text-decoration: none;
    }

.x .notif-count {
      position: absolute;
      top: 8px;
      right: 10px;
      background: red;
      color: white;
      font-size: 12px;
      font-weight: bold;
      padding: 2px 6px;
      border-radius: 50%;
    }
    
  </style>
</head>
<body>
  <div class="nav">
    <?php
              require_once 'My_basse.php';
              $us = $_SESSION['user']['nom'];
              $po = $conn->prepare('SELECT COUNT(*) As total FROM notification WHERE nom = ?');
              $po->execute([$us]);
              $res = $po->fetchAll(PDO::FETCH_ASSOC);
             
            ?>
    <h1>My Task</h1>
    <a onclick="not()" class="x" ><i style="font-size:24px" class="fa">&#xf0f3;</i>
    <span class="notif-count">
      <?= $res[0]['total']?>
    </span></a>
  </div>
<div id="idd" style="display:none; position: absolute; top: 60px; right: 20px; background:white; color:black; padding:10px; width: 300px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.2); z-index: 1001;">
  <?php
    require_once 'My_basse.php';
    $us = $_SESSION['user']['nom'];
    $po = $conn->prepare('SELECT type FROM notification WHERE nom = ? ORDER BY id DESC');
    $po->execute([$us]);
    $res = $po->fetchAll(PDO::FETCH_ASSOC);
    if(count($res) > 0){
      foreach($res as $r){
        echo "<p style='border-bottom:1px solid #ccc;padding:5px 0;'>".$r['type']."</p>";
      }
    }else{
      echo "<p>No notifications</p>";
    }
  ?>
</div>

  <div class="container" data-aos="fade-up">
    <!-- Sidebar -->
    <div class="sidebar">
      <i style="font-size: 144px;" class="fas fa-user-circle"></i>
      <h2>Mr <?php  echo $_SESSION['user']['nom']?></h2>
      <p class="active"><i class="fas fa-tachometer-alt"></i><a  href="home_user.php">Dashboard</a></p>
      <p><i class="fas fa-users-cog"></i><a href="my_task.php">My Task</a></p>
      <p><i class="fas fa-tasks"></i><a href="notifications.php">Notifications</a></p>
      <p><i class="fas fa-sign-out-alt"></i><a href="Logout_admin.php">Logout</a></p>
    </div>

    <!-- Main Content -->
    <div class="content">
      <div class="card-row">
        <a href="#" class="card-link">
          <div class="card">
            <i class="fas fa-user"></i>
            <?php
              require_once 'My_basse.php';
              $us = $_SESSION['user']['nom'];
              $po = $conn->prepare('SELECT COUNT(*) As total FROM task WHERE assigned = ?');
              $po->execute([$us]);
              $res = $po->fetchAll(PDO::FETCH_ASSOC);
             
            ?>
            <h3>My Tasks <?= $res[0]['total'] ?></h3>
          </div>
        </a>
        <a href="#" class="card-link">
          <div class="card">
            <i class="fas fa-tasks"></i>
            <?php
            require_once 'My_basse.php';
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'pending' and assigned = ?");
            $po->execute( [$us] );
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3>Overdue <?= $res[0]['total'] ?></h3>
          </div>
        </a>
        <a href="#" class="card-link">
          <div class="card">
            <i class="far fa-circle"></i>
            <h3>No Deadline 0</h3>
          </div>
        </a>
      </div>

      <!--  -->
      <div class="card-row">
        <a href="#" class="card-link">
          <div class="card">
            <i class="far fa-square"></i>
            <?php
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'pending' and assigned = ?");
            $po->execute( [$us] );
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3>Pending <?= $res[0]['total'] ?></h3>
          </div>
        </a>
        <a href="#" class="card-link">
          <div class="card">
            <i class="fas fa-spinner"></i>
            <?php
            require_once 'My_basse.php';
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'In Progress' and assigned = ?");
            $po->execute([$us]);
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3>In Progress <?= $res[0]['total'] ?></h3>
          </div>
        </a>
        <a href="#" class="card-link">
          <div class="card">
            <i class="fas fa-check-square"></i>
            <?php
            require_once 'My_basse.php';
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'Completed' and assigned = ?");
            $po->execute([$us]);
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3>Completed <?= $res[0]['total'] ?></h3>
          </div>
        </a>
      </div>
    </div>
  </div>
  <script>
    
      
   function not(){
  let id = document.getElementById('idd');
  if (id.style.display === "none") {
    id.style.display = "block";
  } else {
    id.style.display = "none";
  }
   document.addEventListener("click", function(event) {
    let notifDiv = document.getElementById("idd");
    let bellIcon = document.querySelector(".x");
    if (!notifDiv.contains(event.target) && !bellIcon.contains(event.target)) {
      notifDiv.style.display = "none";
    }
  });
  
}

    
  AOS.init({
    duration: 1000, 
    once: true,     
  });
</script>
</body>
</html>
