<?php
class Usuario
{
    private $conn;
    public $name;
    public $password;
    public $login;
    public $cod;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function criarUsuario($conn)
    {
        $query = "INSERT INTO tab_usuario (per_codigo, usu_nome, usu_senha, usu_login_acesso) VALUES (:cod, :name, :password, :login)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cod', $this->cod);
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
        $query = "SELECT * FROM tab_usuario WHERE usu_acesso_login = :login";
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
}
?>