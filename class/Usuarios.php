<?php
class Usuarios
{
    // Conexão
    private $conn;
    // Tabela do Banco de Dados 
    private $db_table = "usuarios";
    // Colunas utilizadas do Banco de Dados
    public $id;
    public $nome;
    public $email;
    // Conexão com o Banco de Dados
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // GET
    public function getUsuarios()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    // CREATE
    public function createUsuario()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        nome     = :nome, 
                        email    = :email";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind data
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
