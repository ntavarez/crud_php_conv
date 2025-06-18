<?php
class Usuario
{
    private $conn;
    public $name;
    public $password;
    public $login;
    public $usuario_id = [];

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function criarUsuario($conn, $profile)
    {
        $profile_id = $_POST['profile_id'];

        $query = "INSERT INTO tab_usuario (per_codigo, usu_nome, usu_senha, usu_login_acesso) VALUES (:cod, :name, :password, :login)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cod', $profile_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':login', $this->login);
        return $stmt->execute();
    }

    public function listarUsuarios()
    {
        $query = "SELECT * FROM tab_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function buscarUsuario()
    {
        $query = "SELECT usu_codigo FROM tab_usuario WHERE usu_login_acesso = :login";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':login', $this->login);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario) {
            return $usuario['usu_codigo'];
        } else {
            return null;
        }
    }

    public function atualizarUsuario($id)
    {
        $query = "UPDATE tab_usuario SET usu_nome = :name, usu_senha = :password, usu_login_acesso = :login WHERE usu_codigo = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deletarUsuario($id)
    {
        $query = "DELETE FROM tab_usuario WHERE usu_codigo = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function validarSenha(){
        $query = "SELECT usu_senha FROM tab_usuario WHERE usu_login_acesso = :login";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':login', $this->login);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($this->password == $usuario['usu_senha']) {
            header("Location: home.php");
        } else {
            echo "Usuário ou senha incorreta!";
            header("Location: login.php");
        }
    }

    public function validarNomePorId($id){

    }
}
?>