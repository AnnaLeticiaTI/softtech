<?php
// api/auth/check.php - Verificar Sessão
session_start();
header("Content-Type: application/json; charset=UTF-8");

if(isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    http_response_code(200);
    echo json_encode(array(
        "success" => true,
        "logado" => true,
        "usuario" => array(
            "id" => $_SESSION['usuario_id'],
            "nome" => $_SESSION['usuario_nome'],
            "email" => $_SESSION['usuario_email'],
            "tipo" => $_SESSION['usuario_tipo']
        )
    ));
} else {
    http_response_code(401);
    echo json_encode(array(
        "success" => false,
        "logado" => false,
        "message" => "Usuário não autenticado."
    ));
}
?>