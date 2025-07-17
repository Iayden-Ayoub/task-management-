<?php
$db="taskk";
$user='root';
$password="";
$host="localhost";
$port="308";
$conn=new PDO("mysql:host=$host;dbname=$db;port=$port",$user,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>