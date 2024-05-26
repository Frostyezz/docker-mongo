<?php
require '/var/www/vendor/autoload.php';
$hostname = 'mongodb://root:mongopwd@mongo:27017';
$database = 'flowers1';

try {
    $client = new MongoDB\Client($hostname);
    $db = $client->$database;
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
?>
