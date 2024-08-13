<?php
include_once './connection.php';
$object = new Connection();
$connection = $object->Connect();

$option = (isset($_POST['option'])) ? $_POST['option'] : null;

$query = "SELECT value, date FROM logs ORDER BY id DESC LIMIT 1;";
$result = $connection->prepare($query);
$result->execute();
$data = $result->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$connection = NULL;