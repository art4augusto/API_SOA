<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/Usuarios.php';

$database = new Database();
$db = $database->getConnection();

$item = new Usuarios($db);

$data = json_decode(file_get_contents("php://input"));

$item->id = $data->id;

$item->nome     = $data->nome;

if ($item->updateUsuario()) {
    echo json_encode("Nome alterado com Sucesso.");
} else {
    echo json_encode("Não foi possível alterar o nome.");
}
