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
    public $senha;
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
                        email    = :email, 
                        senha    = :senha";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = htmlspecialchars(strip_tags($this->senha));

        // bind data
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // login user method
    function login()
    {
        // select all query with user inputed username and password
        $query = "SELECT
                    `id`, `nome`, `senha`       
                             FROM
                    " . $this->db_table . " 
                WHERE
                    nome='" . $this->username . "' AND password='" . $this->senha . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


    // UPDATE
    public function updateUsuario()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        nome     = :nome
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = htmlspecialchars(strip_tags($this->senha));

        // bind data
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // DELETE
    public function deleteUsuario()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
