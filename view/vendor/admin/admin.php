<?php
if(session_status()===PHP_SESSION_NONE) session_start();
include_once "../../../model/login.php";
$login=new login("","","");
$login->protect();
$list=$login->list_All("usuario");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <title>site</title>
</head>
<body>
    <div class="center">
        <nav>
            <a href="../../../controller/login/logout.php">logout</a>
        </nav>
            <h1>inicio do admin</h1>
           <p style="color: red;">
      <?php
      if(isset($_SESSION["sms"])) echo $_SESSION["sms"];
      ?>
      </p>
    <table border="1">
        <tr>
          <th>id</th>
          <th>nome</th>
          <th>email</th>
          <!-- <th>senha</th> -->
          <th>editer</th>
          <th>delete</th>
        </tr>
        <?php while($lina=$list->fetch_assoc()){?>
            <tr>
              <td class="info-dado"><?=$lina['id_usuario']?></td>
                <td class="info-dado"><?=$lina['nome']?></td>
                <td class="info-dado"><?=$lina['email']?></td>
                <!-- <td class="info-dado"><?=$lina['senha']?></td> -->
                <td><a href="editor/editer_usr.php?id=<?=$lina['id_usuario']?>" class="btn-edite">editer</a></td>
                <td><a href="../../../controller/login/delete.php?id=<?=$lina['id_usuario']?>&nome=<?=$lina['nome']?>" class="btn-delete">delete</a></td>
            </tr>
        <?php }?>
    </table>
    </div>
</body>
</html>