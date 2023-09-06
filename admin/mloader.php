<?php
include_once __DIR__ . '/../vendor/database/database.php';
// include_once __DIR__ . '/firmware_add.php';


$brand_id = $_POST['bid'];
// echo $brand_id;
$con = Database::connect();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM models WHERE brands_id = $brand_id";
        $statement = $con->prepare($sql); 
        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

foreach($result as $item){
    echo '<option value=' . $item['id'] . '>' . $item['name'] . '</option>';
} 