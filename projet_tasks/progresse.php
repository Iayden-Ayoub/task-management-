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
        border-spacing: 0px;
    }
    tr td{
        text-align: center;
        padding: 10px;
    }
  </style>
</head>
<body>
  <div class="container" data-aos="fade-up">
    <!-- Sidebar -->
    <div class="sidebar" >
      <i style="font-size: 144px;" class="fas fa-user-circle"></i>
      <h2>Admin</h2>
      <p><i class="fas fa-tachometer-alt"></i><a  href="home_admin.php">Dashboard</a></p>
      <p><i class="fas fa-users-cog"></i><a href="manager.php">Manage User</a></p>
      <p><i class="fas fa-plus"></i><a href="create_task.php">Create Task</a></p>
      <p class="active"><i class="fas fa-tasks"></i><a href="all_task.php">All Tasks</a></p>
      <p><i class="fas fa-sign-out-alt"></i><a href="Logout_admin.php">Logout</a></p>
    </div>

    <!-- Main Content -->
    <div class="content">
<form action="create_task.php" method="post">
    <input type="submit" value="Create Task" style="color:white;margin-bottom: 20px;background-color:green;width:120px;height:30px;border:none;border-radius:10px;cursor:pointer">
    <input type="hidden" name="id" value="<?php echo 1; ?>">
</form>
<div style="display: flex;" ><a href="Due_Today.php" style="margin-right: 20px;">Due_Today</a><a href="Overdue.php" style="margin-right: 20px;">Overdue</a><a href="Completed.php" style="margin-right: 20px;">Completed</a><a href="progresse.php" style="margin-right: 20px;">progresse</a><a href="all_task.php" style="margin-right: 20px;">all_task</a></div>
<?php
            require_once 'My_basse.php';
            $po = $conn->prepare("SELECT COUNT(*) As total FROM task WHERE statu = 'In Progress'");
            $po->execute();
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
            ?>
        <h2>All Tasks (<?php ECHO $res[0]['total']; ?>)</h2>
      <?php
      
      
            $po = $conn->prepare("SELECT * FROM task WHERE statu = 'In Progress'");
            $po->execute();
            $res = $po->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <br><br><br>
<table border="1">
    <tr>
        <th>#</th>
        <th>title</th>
        <th>description</th>
        <th>date_task</th>
        <th>assigned</th>
        <th>statu</th>
        <th>Action</th>
    </tr>
    
      <?php foreach($res as $row){?>
        <tr>
        <td><?= $row['id']?></td>
        <td><?= $row['title']?></td>
        <td><?= $row['description']?></td>
        <td><?= $row['date_task']?></td>
        <td><?= $row['assigned']?></td>
        <td><?= $row['statu']?></td>
        <td>
            <form action="update_task.php" method="post">
                <input type="submit" value="Update" style="background-color: green;border:none;width:70px;height:30px;border-radius:10px;color:white;cursor: pointer;">
                <input type="hidden" name="id" value="<?= $row['id']?>">
            </form><br>
            <form action="delete_task.php" method="post">
                <input onclick="return confirm('Are You Shor Deleted Task')" type="submit" value="Delete" style="background-color: red;border:none;width:70px;height:30px;border-radius:10px;color:white;cursor: pointer;">
                <input type="hidden" name="id" value="<?= $row['id']?>">
            </form>
        </td>
    </tr> <?php } ?>
</table>
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
