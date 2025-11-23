<?php
// classes/Candidato.php - Classe de Candidato

class Candidato {
    private $conn;
    private $table = "candidatos";

    public $id;
    public $usuario_id;
    public $nome_completo;
    public $cpf;
    public $data_nascimento;
    public $cargo_interesse;
    public $area_atuacao;
    public $nivel_experiencia;
    public $curriculo_arquivo;
    public $linkedin;
    public $pretensao_salarial;
    public $disponibilidade;
    public $observacoes;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function criar() {
        $query = "INSERT INTO " . $this->table . " 
                  (usuario_id, nome_completo, cpf, data_nascimento, cargo_interesse, 
                   area_atuacao, nivel_experiencia, curriculo_arquivo, linkedin, 
                   pretensao_salarial, disponibilidade, observacoes) 
                  VALUES (:usuario_id, :nome_completo, :cpf, :data_nascimento, 
                          :cargo_interesse, :area_atuacao, :nivel_experiencia, 
                          :curriculo_arquivo, :linkedin, :pretensao_salarial, 
                          :disponibilidade, :observacoes)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":usuario_id", $this->usuario_id);
        $stmt->bindParam(":nome_completo", $this->nome_completo);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":data_nascimento", $this->data_nascimento);
        $stmt->bindParam(":cargo_interesse", $this->cargo_interesse);
        $stmt->bindParam(":area_atuacao", $this->area_atuacao);
        $stmt->bindParam(":nivel_experiencia", $this->nivel_experiencia);
        $stmt->bindParam(":curriculo_arquivo", $this->curriculo_arquivo);
        $stmt->bindParam(":linkedin", $this->linkedin);
        $stmt->bindParam(":pretensao_salarial", $this->pretensao_salarial);
        $stmt->bindParam(":disponibilidade", $this->disponibilidade);
        $stmt->bindParam(":observacoes", $this->observacoes);

        return $stmt->execute();
    }

    public function listarTodos($status = null) {
        $query = "SELECT c.*, u.email, u.telefone 
                  FROM " . $this->table . " c
                  INNER JOIN usuarios u ON c.usuario_id = u.id";
        
        if($status) {
            $query .= " WHERE c.status = :status";
        }
        
        $query .= " ORDER BY c.data_candidatura DESC";

        $stmt = $this->conn->prepare($query);
        
        if($status) {
            $stmt->bindParam(":status", $status);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>