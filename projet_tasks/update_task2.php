<?php
session_start();
require_once 'My_basse.php';
if(!isset($_SESSION['id'])){
    $_SESSION['id'] = $_POST['id'];
}
$aff = $conn->prepare('SELECT * FROM task WHERE id = ?');
$aff->execute([$_SESSION['id']]);
$ress = $aff->fetch();
      /* $d = date("Y-m-d");
      $description = $ress['description'];
      $assigned =$ress['assigned'];
      $io = $conn->prepare("INSERT INTO notification VALUES (NULL, ?,?, ?, ?)");
      $io->execute(array( $description, "Update Task", $d, $assigned)); */
?>


<form action="" method="post">
    <br><br>
    <select id="wwwww" style="width: 40%;height:30px;padding:5px;border:1px solid black;outline:none;border-radius:10px;text-align:center" name="statu" id="">
            <option value="pending">pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select><br><br>
    <input style="background-color: green;margin-left:50px;width:30%;height:35px;border:none;border-radius:10px;color:white;cursor:pointer" type="submit" value="Update" name="btn">
</form>

<?php






if(isset($_POST['btn'])){
    $statu = $_POST['statu'];
    $id = $_SESSION['id'];
    if(empty($statu)){
        ?>
        <script>
            alert('le champs vide !')
        </script>
        <?php
    }else{
        $po =$conn->prepare('UPDATE task SET statu = ? WHERE id = ? ');
        $po->execute(([$statu,$_SESSION['id']]));
        header(('location:My_task.php'));
    }
}


?>
