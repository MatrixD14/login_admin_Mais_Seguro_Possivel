<?php
include_once "../../../model/login.php";
include_once "../../index.html";
$login=new login("","","");
$login->protect();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>site</title>
</head>
<body>
    <a href="<?=$login->logout()?>">logout</a>
    <h1>inicio do admin</h1>
    <table>
        <?php
        list_table();
        ?>
    </table>
</body>
</html>