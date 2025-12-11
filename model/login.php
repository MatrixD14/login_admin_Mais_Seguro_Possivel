<?php 
require_once 'env.php';
Env::load();

class login{
    private $connect;
    public $nome,$email,$senha;
    public function __construct($nome,$email,$senha){
        $this->nome=$nome;
        $this->email=$email;
        $this->senha=$senha;
        $this->connects();
    }
    public function connects(){
        $this->connect=new mysqli($_ENV["HOST"],$_ENV["USER"],$_ENV["PASSWORD"],$_ENV["DATABASE"],$_ENV['PORT']);
        if($this->connect->connect_error) die("error connect on database".$this->connect->connect_error);
        return $this->connect;
    }
    public function create_login(){
        $password=password_hash($this->senha,PASSWORD_DEFAULT);
        $tmg = $this->connect->prepare("insert into usuario(nome,email,senha)values(?,?,?)");
        // $tmg = $this->connect->prepare("insert into admins(email,senha)values(?,?)");
         $tmg->bind_param("ss",$this->email,$password);
        if(!$tmg->execute()) die("commad nao executado");
        $tmg->close();
    }
    public function login(){
        $tmg = $this->connect->prepare("select * from usuario where email=?");
        $tmg->bind_param("s",$this->email);
        if(!$tmg->execute())die("commad nao executado");
        $result=$tmg->get_result() or die("falha na execução do command ".$this->connect->connect_error);
        $tmg->close();
        return $result;
    }
    public function login_admin(){
        $tmg = $this->connect->prepare("select * from admins where email=?");
        $tmg->bind_param("s",$this->email);
        if(!$tmg->execute())die("commad nao executado");
        $result=$tmg->get_result() or die("falha na execução do command ".$this->connect->connect_error);
        $tmg->close();
        return $result;
    }
    public function logout(){
        if(!isset($_SESSION))session_start();
        session_destroy();
        return "../../index.html";
    }
    public function protect(){
        if(!isset($_SESSION))session_start();
        if(!isset($_SESSION['id'])) die("não nao tem permissão para acessar essa página <a href=\"../../index.html\">sair</a>");
    }
    public function close(){
        if($this->connect) $this->connect->close();
    }
}