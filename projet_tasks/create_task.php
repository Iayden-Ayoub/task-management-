
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
      <p><i class="fas fa-tachometer-alt"></i><a  href="home_admin.php">Dashboard</a></p>
      <p><i class="fas fa-users-cog"></i><a href="manager.php">Manage User</a></p>
      <p class="active"><i class="fas fa-plus"></i><a href="create_task.php">Create Task</a></p>
      <p><i class="fas fa-tasks"></i><a href="all_task.php">All Tasks</a></p>
      <p><i class="fas fa-sign-out-alt"></i><a href="Logout_admin.php">Logout</a></p>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div id="msg"></div>
        <h1>Insert Task</h1>
        <form action="" method="post">
        <input id="w" style="width: 40%;height:30px;padding:10px;border:1px solid black;outline:none;border-radius:10px;text-align:center" type="text" name="title" placeholder="entre un titre de task"><br><br>
        <input id="ww" style="width: 40%;height:30px;padding:10px;border:1px solid black;outline:none;border-radius:10px;text-align:center" type="text" name="description" placeholder="entre une description de task"><br><br>
        <label>Date-Fine-Task</label><br>
        <input id="www" style="width: 40%;height:30px;padding:10px;border:1px solid black;outline:none;border-radius:10px;text-align:center" type="date" name="date"><br><br>
        
        <select id="wwww" style="width: 40%;height:30px;padding:5px;border:1px solid black;outline:none;border-radius:10px;text-align:center" name="assigned" id="">
            <?php
            require_once 'My_basse.php';
                $po = $conn->prepare('SELECT * FROM employe');
                $po->execute();
                $res = $po->fetchAll(PDO::FETCH_ASSOC);
                foreach ($res as $row) {
                    echo '<option value="'.$row['nom'].'">'.$row['nom'].'</option>';
                }
            ?>
        </select><br><br>
        
        <select id="wwwww" style="width: 40%;height:30px;padding:5px;border:1px solid black;outline:none;border-radius:10px;text-align:center" name="statu" id="">
            <option value="pending">pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select><br><br>
        <input style="background-color: green;margin-left:50px;width:30%;height:35px;border:none;border-radius:10px;color:white;cursor:pointer" type="submit" value="Insert" name="btn">
    </form>
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

<?php
require_once 'My_basse.php';
if(isset($_POST['btn'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $assigned = $_POST['assigned'];
    $statu = $_POST['statu'];
    if(empty( $title) || empty($description) || empty($date) || empty($assigned)){
        ?>
         <script>
            alert('Please fill all the fields')
         </script>
        <?php
    }else{
      $d = date("Y-m-d");
      $io = $conn->prepare("INSERT INTO notification VALUES (NULL, ?,?, ?, ?)");
      $io->execute(array( $description, "Create Task", $d, $assigned));
        $po = $conn->prepare('INSERT INTO task Values (null,?,?,?,?,?)');
        $po->execute([$title, $description, $date, $assigned,$statu]);
        ?>
           <script>
  const div = document.getElementById('msg');
  div.innerHTML = `
    <div data-aos="fade-down" class="alert alert-success" role="alert" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px;">
      ✅ Task created successfully
    </div>
  `;

  setTimeout(function () {
    div.innerHTML = '';
  }, 3000);
  let w = document.getElementById('w');
  w.value = '';
  let d = document.getElementById('ww');
  d.value = '';
  let t = document.getElementById('www');
  t.value = '';
  let a = document.getElementById('wwww');
  a.value = '';
  let s = document.getElementById('wwwww');
  s.value = '';
  
</script>
<?php



/* if (!isset($_SESSION['id']) && isset($_POST['id'])) {
    $_SESSION['id'] = $_POST['id'];
}

if (isset($_SESSION['id'])) {
    if ($_SESSION['id'] == 1) {
        header('Location: all_task.php');
        exit;
    }

} */

    }
}

?>