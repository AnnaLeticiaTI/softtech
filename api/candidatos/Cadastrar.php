<?php
// api/candidatos/cadastrar.php - Cadastrar Candidato
session_start();
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../classes/Candidato.php';

if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    http_response_code(401);
    echo json_encode(array("success" => false, "message" => "Não autorizado."));
    exit;
}

$database = new Database();
$db = $database->getConnection();
$candidato = new Candidato($db);

// Processar upload de currículo
$curriculo_arquivo = null;
if(isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == 0) {
    $diretorio = '../../uploads/curriculos/';
    if(!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }
    
    $extensao = pathinfo($_FILES['curriculo']['name'], PATHINFO_EXTENSION);
    $nome_arquivo = uniqid() . '_' . time() . '.' . $extensao;
    $caminho_completo = $diretorio . $nome_arquivo;
    
    if(move_uploaded_file($_FILES['curriculo']['tmp_name'], $caminho_completo)) {
        $curriculo_arquivo = 'uploads/curriculos/' . $nome_arquivo;
    }
}

$candidato->usuario_id = $_SESSION['usuario_id'];
$candidato->nome_completo = $_POST['nome_completo'];
$candidato->cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$candidato->data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : null;
$candidato->cargo_interesse = $_POST['cargo_interesse'];
$candidato->area_atuacao = isset($_POST['area_atuacao']) ? $_POST['area_atuacao'] : null;
$candidato->nivel_experiencia = isset($_POST['nivel_experiencia']) ? $_POST['nivel_experiencia'] : null;
$candidato->curriculo_arquivo = $curriculo_arquivo;
$candidato->linkedin = isset($_POST['linkedin']) ? $_POST['linkedin'] : null;
$candidato->pretensao_salarial = isset($_POST['pretensao_salarial']) ? $_POST['pretensao_salarial'] : null;
$candidato->disponibilidade = isset($_POST['disponibilidade']) ? $_POST['disponibilidade'] : null;
$candidato->observacoes = isset($_POST['observacoes']) ? $_POST['observacoes'] : null;

if($candidato->criar()) {
    http_response_code(201);
    echo json_encode(array(
        "success" => true,
        "message" => "Candidatura enviada com sucesso!"
    ));
} else {
    http_response_code(503);
    echo json_encode(array(
        "success" => false,
        "message" => "Não foi possível processar a candidatura."
    ));
}
?>