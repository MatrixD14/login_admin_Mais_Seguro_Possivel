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
         $tmg->bind_param("sss",$this->nome,$this->email,$password);
        $result=$tmg->execute();
        $tmg->close();
        return $result;
    }
    public function login_UsrAdmin($table){
        $tmg = $this->connect->prepare("select * from ".$table." where email=?");
        $tmg->bind_param("s",$this->email);
        if(!$tmg->execute())die("commad nao executado");
        $result=$tmg->get_result() or die("falha na execução do command ".$this->connect->connect_error);
        $tmg->close();
        return $result;
    }
    public function list_All($table){
        $tmg = $this->connect->prepare("select * from $table");
        if(!$tmg->execute())die("commad nao executado");
        return $tmg->get_result();
    }
    public function protect(){
      if(!isset($_SESSION['id'])) die("não nao tem permissão para acessar essa página <a href=\"../../index.html\">sair</a>");
    }
    public function delete_usr($id){
        $tmg=$this->connect->prepare("delete from usuario where id_usuario=?");
        $tmg->bind_param("i",$id);
        $tmg->execute();
        $tmg->close();
    }
    public function get_id_usr($table,$id_pk,$id){
        $tmg = $this->connect->prepare("select * from $table where $id_pk=?");
        $tmg->bind_param("i",$id);
        if(!$tmg->execute())die("commad nao executado");
        return $tmg->get_result();
    }
    
    public function edite_usr($id){
      if(!empty($this->senha)){
        $password=password_hash($this->senha,PASSWORD_DEFAULT);
        $tmg = $this->connect->prepare("update usuario set nome=?, email=?, senha=? where id_usuario=?");
         $tmg->bind_param("sssi",$this->nome,$this->email,$password,$id);
        }else{
          $tmg = $this->connect->prepare("update usuario set nome=?, email=? where id_usuario=?");
         $tmg->bind_param("ssi",$this->nome,$this->email,$id);
        }
        if(!$tmg->execute()) die("commad nao executado");
        $tmg->close();
    }
    public function close(){
        if($this->connect) $this->connect->close();
    }
}