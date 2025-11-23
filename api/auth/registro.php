<?php
// api/auth/registro.php - API de Registro
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '../../config/database.php';
include_once '../../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nome) && !empty($data->email) && !empty($data->senha)) {
    
    if($usuario->buscarPorEmail($data->email)) {
        http_response_code(409);
        echo json_encode(array(
            "success" => false,
            "message" => "Este email já está cadastrado."
        ));
        exit;
    }
    
    $usuario->nome = $data->nome;
    $usuario->email = $data->email;
    $usuario->senha = $data->senha;
    $usuario->telefone = isset($data->telefone) ? $data->telefone : null;
    $usuario->tipo_usuario = isset($data->tipo_usuario) ? $data->tipo_usuario : 'cliente';
    
    if($usuario->criar()) {
        http_response_code(201);
        echo json_encode(array(
            "success" => true,
            "message" => "Usuário cadastrado com sucesso!",
            "usuario_id" => $usuario->id
        ));
    } else {
        http_response_code(503);
        echo json_encode(array(
            "success" => false,
            "message" => "Não foi possível criar o usuário."
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