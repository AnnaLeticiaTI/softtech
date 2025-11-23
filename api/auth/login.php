<?php
// api/auth/login.php - API de Login
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../classes/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email) && !empty($data->senha)) {
    
    if($usuario->login($data->email, $data->senha)) {
        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;
        $_SESSION['usuario_tipo'] = $usuario->tipo_usuario;
        $_SESSION['logado'] = true;
        
        http_response_code(200);
        echo json_encode(array(
            "success" => true,
            "message" => "Login realizado com sucesso!",
            "usuario" => array(
                "id" => $usuario->id,
                "nome" => $usuario->nome,
                "email" => $usuario->email,
                "tipo" => $usuario->tipo_usuario
            )
        ));
    } else {
        http_response_code(401);
        echo json_encode(array(
            "success" => false,
            "message" => "Email ou senha incorretos."
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