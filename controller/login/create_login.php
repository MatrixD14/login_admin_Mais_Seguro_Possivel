<?php
ob_start();
if(session_status()===PHP_SESSION_NONE) session_start();
include_once "../../model/login.php";
function log_smg($log){
    $_SESSION["log_create"]=$log;
    header('location: ../../view/vendor/create_login/create_login.php');
    exit;
}
$nome = $_POST['nome'];
$Email= $_POST['email'];
$PassWord= $_POST['password'];
if(isset($nome,$Email,$PassWord)){
    if(strlen($nome)==0) log_smg("preencha o campo nome");
    else if(strlen($Email)==0) log_smg("preencha o campo email");
    else if(strlen($PassWord)==0)log_smg("preencha o campo senha");
    else{
        $login= new login($nome,$Email,$PassWord);
        $check=$login->login_UsrAdmin("usuario");
        if($check && $check->num_rows > 0) log_smg("conta já existente");
        elseif($login->create_login()){
        $_SESSION["log_create"]="<p style=\"color: green;\">criando com sucesso<p>";
        header('location: ../../view/index.php');
        exit;
        }
        else log_smg("erro ao create conta");
        $login->close();
    }
}
ob_end_flush();