<?php
// classes/Contato.php - Classe de Contato

class Contato {
    private $conn;
    private $table = "contatos";

    public $id;
    public $nome;
    public $email;
    public $telefone;
    public $assunto;
    public $mensagem;
    public $tipo;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function criar() {
        $query = "INSERT INTO " . $this->table . " 
                  (nome, email, telefone, assunto, mensagem, tipo) 
                  VALUES (:nome, :email, :telefone, :assunto, :mensagem, :tipo)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":assunto", $this->assunto);
        $stmt->bindParam(":mensagem", $this->mensagem);
        $stmt->bindParam(":tipo", $this->tipo);

        return $stmt->execute();
    }

    public function listarTodos($status = null) {
        $query = "SELECT * FROM " . $this->table;
        
        if($status) {
            $query .= " WHERE status = :status";
        }
        
        $query .= " ORDER BY data_envio DESC";

        $stmt = $this->conn->prepare($query);
        
        if($status) {
            $stmt->bindParam(":status", $status);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>