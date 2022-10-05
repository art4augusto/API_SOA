<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/Usuarios.php';

$database = new Database();
$db = $database->getConnection();
$item = new Usuarios($db);
$data = json_decode(file_get_contents("php://input"));

$item->nome     = $data->nome;
$item->email    = $data->email;
$item->senha    = md5($data->senha);

if ($item->createUsuario()) {
    echo json_encode("Usuario Cadastrado com Sucesso!");
} else {
    echo json_encode("Usuario não Cadastrado!");
}
