<?php
include_once "../../model/login.php";
$login=new login("","","");
$login->protect();
function list_table(){ 
    while($lina =$this->ligin->login()->fetch_assoc()){
       echo "<tr>
       <td>".$lina['nome']."</td>
       <td>".$lina['email']."</td>
       <td>".$lina['senha']."</td>
       </tr>";

    }
}
