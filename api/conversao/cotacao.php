<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

$money  = $data->money;

$api_url = "https://economia.awesomeapi.com.br/json/last/" . $money;

$response = file_get_contents($api_url);

echo $response;
