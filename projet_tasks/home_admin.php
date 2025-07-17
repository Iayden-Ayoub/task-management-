<?php
session_start();
if(!isset($_SESSION['admin'])){
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
  </style>
</head>
<body>
  <div class="container" data-aos="fade-up">
    <!-- Sidebar -->
    <div class="sidebar">
      <i style="font-size: 144px;" class="fas fa-user-circle"></i>
      <h2>Admin</h2>
      <p class="active"><i class="fas fa-tachometer-alt"></i><a  href="home_admin.php">Dashboard</a></p>
      <p><i class="fas fa-users-cog"></i><a href="manager.php">Manage User</a></p>
      <p><i class="fas fa-plus"></i><a href="create_task.php">Create Task</a></p>
      <p><i class="fas fa-tasks"></i><a href="all_task.php">All Tasks</a></p>
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
              $po = $conn->prepare('SELECT COUNT(*) As total FROM employe');
              $po->execute();
              $res = $po->fetchAll(PDO::FETCH_ASSOC);
             
            ?>
            <h3>Employe <?= $res[0]['total'] ?></h3>
          </div>
        </a>
        <a href="#" class="card-link">
          <div class="card">
            <i class="fas fa-tasks"></i>
            <?php
            require_once 'My_basse.php';
            $po = $conn->prepare('SELECT COUNT(*) As total FROM task');
            $po->execute();
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3>All Tasks <?= $res[0]['total'] ?></h3>
          </div>
        </a>
        <a href="#" class="card-link">
          <div class="card">
            <i class="fas fa-times-circle"></i>
            <?php
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'pending'");
            $po->execute();
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3>Overdue <?= $res[0]['total'] ?></h3>
          </div>
        </a>
      </div>

      <div class="card-row">
        <a href="#" class="card-link">
          <div class="card">
            <i class="far fa-circle"></i>
            <h3>No Deadline 0</h3>
          </div>
        </a>
        <a href="#" class="card-link">
          <div class="card">
            <i class="fas fa-exclamation-triangle"></i>
            <?php
            require_once 'My_basse.php';
            $datee = date('Y-m-d');
            $po = $conn->prepare('SELECT COUNT(*) As total FROM task WHERE date_task = ?');
            $po->execute([$datee]);
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3>Due Today <?= $res[0]['total'] ?></h3>
          </div>
        </a>
        <a href="#" class="card-link">
          <div class="card">
            <i class="fas fa-bell"></i>
            <h3>Notifications 0</h3>
          </div>
        </a>
      </div>
      <div class="card-row">
        <a href="#" class="card-link">
          <div class="card">
            <i class="far fa-square"></i>
            <?php
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'pending'");
            $po->execute();
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
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'In Progress'");
            $po->execute();
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
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'Completed'");
            $po->execute();
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h3>Completed <?= $res[0]['total'] ?></h3>
          </div>
        </a>
      </div>
    </div>
  </div>
  <script>
  AOS.init({
    duration: 1000, 
    once: true,     
  });
</script>
</body>
</html>
