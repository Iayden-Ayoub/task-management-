<?php
session_start();
require_once 'My_basse.php';
session_destroy();
header('location:home.php');
?>