<?php

include_once '../../config/database.php';
include_once '../../class/Usuarios.php';

$database = new Database();
$db = $database->getConnection();

$user = new Usuarios($db);

// set ID property of user to be edited
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());

// read the details of user to be edited
$stmt = $user->login();
if ($stmt->rowCount() > 0) {
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr = array(
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $row['id'],
        "username" => $row['username']
    );
} else {
    $user_arr = array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}
// make it json format
echo (json_encode($user_arr));
