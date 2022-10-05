<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/Usuarios.php';

$database = new Database();
$db = $database->getConnection();

$item = new Usuarios($db);

$data= json_decode(file_get_contents("php://input"));

$item->id = $data->id;

if ($item->deleteUsuario()) {
    echo json_encode("Usuario excluído.");
} else {
    echo json_encode("Os dados não puderam ser excluídos.");
}