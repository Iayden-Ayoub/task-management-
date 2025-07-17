<?php
session_start();
require_once 'My_basse.php';
if(!isset($_SESSION['id'])){
    $_SESSION['id'] = $_POST['id'];
}

$aff = $conn->prepare('SELECT * FROM employe WHERE id = ?');
$aff->execute([$_SESSION['id']]);
$ress = $aff->fetch();
?>


<form action="" method="post">
    <input type="text" name="nom" value="<?php echo $ress['nom']?>" placeholder="entrer le nom"><br><br>
    <input type="text" name="prenom" value="<?php echo $ress['prenom']?>" placeholder="entrer le prenom"><br><br>
    <input type="text" name="role" value="<?php echo $ress['role']?>" placeholder="entrer le role"><br><br>
    <input type="submit" value="Update" name="btn">
</form>

<?php






if(isset($_POST['btn'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $role = $_POST['role'];
    if(empty($nom) || empty($prenom) || empty($role)){
        ?>
        <script>
            alert('les est vide !')
        </script>
        <?php
    }else{
        $po =$conn->prepare('UPDATE employe SET nom = ? , prenom = ? , role = ?  WHERE id = ?');
        $po->execute(([$nom,$prenom,$role,$_SESSION['id']]));
        header(('location:manager.php'));
    }
}


?>
