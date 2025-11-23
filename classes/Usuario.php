<?php
// classes/Usuario.php - Classe de Usuário

class Usuario {
    private $conn;
    private $table = "usuarios";

    public $id;
    public $nome;
    public $email;
    public $senha;
    public $telefone;
    public $tipo_usuario;
    public $ativo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function criar() {
        $query = "INSERT INTO " . $this->table . " 
                  (nome, email, senha, telefone, tipo_usuario) 
                  VALUES (:nome, :email, :senha, :telefone, :tipo_usuario)";

        $stmt = $this->conn->prepare($query);

        $this->senha = password_hash($this->senha, PASSWORD_BCRYPT);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":tipo_usuario", $this->tipo_usuario);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function login($email, $senha) {
        $query = "SELECT id, nome, email, senha, tipo_usuario, ativo 
                  FROM " . $this->table . " 
                  WHERE email = :email AND ativo = 1 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($senha, $row['senha'])) {
                $this->id = $row['id'];
                $this->nome = $row['nome'];
                $this->email = $row['email'];
                $this->tipo_usuario = $row['tipo_usuario'];
                
                $this->atualizarUltimoAcesso();
                return true;
            }
        }
        return false;
    }

    private function atualizarUltimoAcesso() {
        $query = "UPDATE " . $this->table . " 
                  SET ultimo_acesso = CURRENT_TIMESTAMP 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
    }

    public function buscarPorEmail($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
}
?>