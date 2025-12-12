<?php
include_once "../../model/login.php";
$login=new login("","","");
$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$id=$_POST['id'];
$login->edite_usr($id);
$_SESSION['sms']="usuario editado ".$nome;
header('location: ../../view/vendor/admin/admin.php');