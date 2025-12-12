<?php
$id=$_GET['id'];
$nome=$_GET['nome'];
$email=$_GET['email'];
$senha=$_GET['senha'];

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
        <?=$id."".$nome."".$email."".$senha?>
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
        <input type="password" name="senha" id="senha" value="<?= $senha ?>" class="input-p">
        <br><br><br>
        <input type="submit" value="enter" class="bt-enter">    
    </form>
    </div>
    </div>
</body>
</html>