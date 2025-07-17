<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


  <title>Task</title>
  <style>
    a {
      text-decoration: none;
    }

    .child1, .child2 {
      width: 300px;
      text-align: center;
      height: 280px;
      background-color: gray;
      border-radius: 20px;
      margin: 120px 250px;
      cursor: pointer;
      box-shadow: 0 0 17px 7px black;
    }
    .child1:hover{
        transform: scale(1.1) ease;
    }
    .child2:hover{
        transform: scale(1.1) ease;
    }
    body{
        background-color:rgba(10, 10, 180, 0.56);
    }
    .child2 {
      margin: -405px 780px;
    }
  </style>
</head>
<body>
    <h1 style="text-align: center;color:white;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif"><b>Task Management System</b></h1>
  <div class="parent">
    <div class="child1" data-aos="fade-up">
      <a href="form_admin.php"><i class="fas fa-user" style="font-size:164px;color: black;width:100%"></i><h1 style="color: white;">Admin</h1></a>
    </div>
    <div class="child2" data-aos="fade-up">
      <a href="form_user.php"><i class="fas fa-user-friends" style="font-size:164px;color: black;width:100%"></i><h1 style="color: white;">Utilisateur</h1></a>
    </div>
  </div>
  <script>
  AOS.init({
    duration: 800, 
    once: true     
  });
</script>

</body>
</html>
