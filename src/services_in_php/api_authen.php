<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
$servername = "localhost";
$root = "root";
$rootpassword = "";
$dbname = "vue";
$req = json_decode(file_get_contents('php://input'));

$connect = new PDO("mysql:host=$servername;dbname=$dbname", "$root", "$rootpassword");


if ($req->action == "login") {
    $data = array(
        ":username" => $req->username,
        ":pass_user" => $req->password
    );
    $query = "SELECT * FROM user  WHERE username = :username AND pass_user = :pass_user";
    $result = $connect->prepare($query);
    $result->execute($data);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($result->rowCount() > 0) {
        if ($req->username == $row['username']) {
            if ($req->password == $row['pass_user']) {
                echo json_encode($row['username']); 
            }
        }
    } else {
        echo "Fail";
    }
}

if ($req->action == "register") {
    $data = array(
        ":username" => $req->username,
        ":pass_user" => $req->password
    );
    $query = "SELECT * FROM user  WHERE username = :username AND pass_user = :pass_user";
    $result = $connect->prepare($query);
    $result->execute($data);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($req->username != $row['username']) {
        if ($req->password != $row['password']) {
            $data = array(
                ":username" => $req->username,
                ":pass_user" => $req->password
            );
            $query = "INSERT INTO user (username,pass_user) VALUES (:username,:pass_user)";
            $result = $connect->prepare($query);
            $result->execute($data);
        }
    }else{
        echo "duplicate";
    }
}
