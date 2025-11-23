<?php
// api/parceiros/cadastrar.php - Cadastrar Parceiro
session_start();
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../classes/Parceiro.php';

if(!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    http_response_code(401);
    echo json_encode(array("success" => false, "message" => "Não autorizado."));
    exit;
}

$database = new Database();
$db = $database->getConnection();
$parceiro = new Parceiro($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nome_empresa) && !empty($data->segmento)) {
    $parceiro->usuario_id = $_SESSION['usuario_id'];
    $parceiro->nome_empresa = $data->nome_empresa;
    $parceiro->cnpj = isset($data->cnpj) ? $data->cnpj : null;
    $parceiro->segmento = $data->segmento;
    $parceiro->descricao = isset($data->descricao) ? $data->descricao : null;
    $parceiro->endereco = isset($data->endereco) ? $data->endereco : null;
    $parceiro->cidade = isset($data->cidade) ? $data->cidade : null;
    $parceiro->estado = isset($data->estado) ? $data->estado : null;
    $parceiro->cep = isset($data->cep) ? $data->cep : null;
    $parceiro->site = isset($data->site) ? $data->site : null;
    
    if($parceiro->criar()) {
        http_response_code(201);
        echo json_encode(array(
            "success" => true,
            "message" => "Solicitação de parceria enviada com sucesso!"
        ));
    } else {
        http_response_code(503);
        echo json_encode(array(
            "success" => false,
            "message" => "Não foi possível processar a solicitação."
        ));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "success" => false,
        "message" => "Dados incompletos."
    ));
}
?>