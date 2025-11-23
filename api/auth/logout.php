<?php
// api/auth/logout.php - API de Logout
session_start();
header("Content-Type: application/json; charset=UTF-8");

session_unset();
session_destroy();

http_response_code(200);
echo json_encode(array(
    "success" => true,
    "message" => "Logout realizado com sucesso!"
));
?>