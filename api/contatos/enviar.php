<?php
// api/contatos/enviar.php - Enviar Contato
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../classes/Contato.php';

$database = new Database();
$db = $database->getConnection();
$contato = new Contato($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nome) && !empty($data->email) && !empty($data->mensagem)) {
    $contato->nome = $data->nome;
    $contato->email = $data->email;
    $contato->telefone = isset($data->telefone) ? $data->telefone : null;
    $contato->assunto = isset($data->assunto) ? $data->assunto : 'Contato Geral';
    $contato->mensagem = $data->mensagem;
    $contato->tipo = isset($data->tipo) ? $data->tipo : 'geral';
    
    if($contato->criar()) {
        http_response_code(201);
        echo json_encode(array(
            "success" => true,
            "message" => "Mensagem enviada com sucesso! Entraremos em contato em breve."
        ));
    } else {
        http_response_code(503);
        echo json_encode(array(
            "success" => false,
            "message" => "Não foi possível enviar a mensagem."
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