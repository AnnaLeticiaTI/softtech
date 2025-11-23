<?php
// classes/Parceiro.php - Classe de Parceiro

class Parceiro {
    private $conn;
    private $table = "parceiros";

    public $id;
    public $usuario_id;
    public $nome_empresa;
    public $cnpj;
    public $segmento;
    public $descricao;
    public $endereco;
    public $cidade;
    public $estado;
    public $cep;
    public $site;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function criar() {
        $query = "INSERT INTO " . $this->table . " 
                  (usuario_id, nome_empresa, cnpj, segmento, descricao, 
                   endereco, cidade, estado, cep, site) 
                  VALUES (:usuario_id, :nome_empresa, :cnpj, :segmento, 
                          :descricao, :endereco, :cidade, :estado, :cep, :site)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usuario_id", $this->usuario_id);
        $stmt->bindParam(":nome_empresa", $this->nome_empresa);
        $stmt->bindParam(":cnpj", $this->cnpj);
        $stmt->bindParam(":segmento", $this->segmento);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":cidade", $this->cidade);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":site", $this->site);

        return $stmt->execute();
    }

    public function listarTodos($status = null) {
        $query = "SELECT p.*, u.nome, u.email 
                  FROM " . $this->table . " p
                  INNER JOIN usuarios u ON p.usuario_id = u.id";
        
        if($status) {
            $query .= " WHERE p.status = :status";
        }
        
        $query .= " ORDER BY p.data_solicitacao DESC";

        $stmt = $this->conn->prepare($query);
        
        if($status) {
            $stmt->bindParam(":status", $status);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>