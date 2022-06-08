<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vue";
$req = json_decode(file_get_contents("php://input"));

$connect = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
$data =array();

if($req->action == "getdata"){
$query = "SELECT * FROM  stock_table";
$result = $connect->prepare($query);
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $data[] = $row;
}
echo json_encode($data);
}


if($req->action == "insertdata"){
    $data =array(
        ':nameItem' => $req->product_name,
        ':priceItem' => $req->product_price,
        ':stockItem' => $req->product_stock
    );
    $query = "INSERT INTO stock_table (name_item, price_item, stock_item)
    VALUES (:nameItem,:priceItem,:stockItem)";
    $result = $connect->prepare($query);
    $result->execute($data);
    var_dump($data);
}

if($req->action == "edit"){
$query = "SELECT * FROM  stock_table WHERE id = '".$req->id."'";
$result = $connect->prepare($query);
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $data['id'] = $row['id'];
    $data['product_name'] = $row['name_item'];
    $data['product_price'] = $row['price_item'];
    $data['product_stock'] = $row['stock_item'];
}
echo json_encode($data);
}

if($req->action == "updatedata"){   
    $data =array(
        ':nameItem' => $req->product_name,
        ':priceItem' => $req->product_price,
        ':stockItem' => $req->product_stock,
        ':id' => $req->id
    );
    $query = "UPDATE stock_table SET name_item = :nameItem, price_item = :priceItem, stock_item = :stockItem
    WHERE id = :id";
    $result = $connect->prepare($query);
    $result->execute($data);
    var_dump($data);
}

if($req->action == "deldata"){
    $query = "DELETE FROM stock_table WHERE id = '".$req->id."' ";
    $result = $connect->prepare($query);
    $result->execute();
    $output = array('message'=> 'This data deleted');
    echo json_encode($output);
}

?>
    