<?php
session_start();
require_once 'My_basse.php';
if(!isset($_SESSION['id'])){
    $_SESSION['id'] = $_POST['id'];
}

$aff = $conn->prepare('SELECT * FROM task WHERE id = ?');
$aff->execute([$_SESSION['id']]);
$ress = $aff->fetch();
?>


<form action="" method="post">
    <input style="width: 40%;height:30px;padding:5px;border:1px solid black;outline:none;border-radius:10px;text-align:center" type="text" name="title" value="<?php echo $ress['title']?>" placeholder="entrer le nom"><br><br>
     <textarea style="width: 40%;height:30px;padding:5px;border:1px solid black;outline:none;border-radius:10px;text-align:center" name="description" rows="8" cols="27"  placeholder="entrer le prenom"><?php echo $ress['description']?></textarea><br><br>
    <input style="width: 40%;height:30px;padding:5px;border:1px solid black;outline:none;border-radius:10px;text-align:center" type="date" name="date" value="<?php echo $ress['date_task']?>" ><br><br>
    <select name="assigned" style="width: 40%;height:30px;padding:5px;border:1px solid black;outline:none;border-radius:10px;text-align:center">
        <?php
            require_once 'My_basse.php';
                $po = $conn->prepare('SELECT * FROM employe');
                $po->execute();
                $res = $po->fetchAll(PDO::FETCH_ASSOC);
                echo '<option value="'.$ress['assigned'].'"> '.$ress['assigned'].'</option>';
                foreach ($res as $row) {
                    echo '<option value="'.$row['nom'].'">'.$row['nom'].'</option>';
                }
            ?>
    </select><br><br>
    <select id="wwwww" style="width: 40%;height:30px;padding:5px;border:1px solid black;outline:none;border-radius:10px;text-align:center" name="statu" id="">
            <option value="<?= $ress['statu'] ?>"> <?= $ress['statu'] ?> </option>
            <option value="pending">pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select><br><br>
    <input style="background-color: green;margin-left:50px;width:30%;height:35px;border:none;border-radius:10px;color:white;cursor:pointer" type="submit" value="Update" name="btn">
</form>

<?php






if(isset($_POST['btn'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $assigned = $_POST['assigned'];
    $statu = $_POST['statu'];
    $id = $_SESSION['id'];
    if(empty($title) || empty($description) || empty($date) || empty($assigned) || empty($statu)){
        ?>
        <script>
            alert('les est vide !')
        </script>
        <?php
    }else{
        $po =$conn->prepare('UPDATE task SET title = ? , description = ? , date_task = ? , assigned = ? , statu = ? WHERE id = ? ');
        $po->execute(([$title,$description,$date,$assigned,$statu,$_SESSION['id']]));
        $d = date("Y-m-d");
      
      $assigned =$ress['assigned'];
      $io = $conn->prepare("INSERT INTO notification VALUES (NULL, ?,?, ?, ?)");
      $io->execute(array( $description, "Update Task", $d, $assigned));
        header(('location:all_task.php'));
    }
}


?>
