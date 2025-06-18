<?php
class BD {
    private $host = 'localhost';
    private $db = 'usuarios';
    private $user = 'root';
    private $password = '';
    public $conn;

    public function conexao() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host}; dbname={$this->db}", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
