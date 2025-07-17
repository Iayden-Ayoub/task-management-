<?php

session_start();
require_once 'My_basse.php';
$id = $_POST['id'];

$po = $conn->prepare('DELETE FROM employe WHERE id = ?');
$po->execute([$id]);
header('location:manager.php');






?>