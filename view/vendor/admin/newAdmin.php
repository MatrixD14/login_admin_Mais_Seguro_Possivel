<?php
include_once "../../../model/login.php";
$login =new login("","","");
$connect = $login->connects();
$senha="285913";
$email="admindeivison@admin.com";
$password=password_hash($senha,PASSWORD_DEFAULT);
$tmg = $connect->prepare("insert into admins(email,senha)values(?,?)");
$tmg->bind_param("ss",$email,$password);
if(!$tmg->execute()) die("commad nao executado");
//$tmg->close();
$login->close();
header('location: ../../index.php');
        
