<?php
if(session_status()===PHP_SESSION_NONE) session_start();
include_once "../../../../model/login.php";
$login=new login("","","");
$login->protect();
$id=$_GET['id'];
$result=$login->get_id_usr("usuario","id_usuario",$id)->fetch_assoc();
$nome=$result['nome'];
$email=$result['email'];
$senha=$result['senha'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/global.css">
    <link rel="stylesheet" href="../../../css/component/button.css">
    <link rel="stylesheet" href="../../../css/component/input.css">
    <title>editor Admin</title>
</head>
<body>
    <div class="center box-border">
        <h1>editor de dados do usuario</h1>
        <?="user: ".$nome?>
    <div class="box-center">
    <form action="../../../../controller/login/editor.php" method="post" >
        <input type="hidden" name="id" value="<?=$id?>" class="input-p">
        <br>
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" id="nome" value="<?= $nome ?>" class="input-p">
        <br>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="<?= $email ?>" class="input-p" >
        <br>
        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" id="senha" class="input-p">
        <br><br>
        <div class="box-center">
        <input type="submit" value="enter" class="bt-enter">
        <p></p>
        <a href="../admin.php">sair</a>
        </div>
        <br>
    </form>
    </div>
    </div>
</body>
</html>