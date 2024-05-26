<?php
require_once 'connection.php';
$collection = $db->flori;

$result = $collection->insertOne([
    'nume' => 'toporasi',
    'culoare' => 'mov',
    'marime' => 'medii',
    'pret' => 80
]);

echo "Inserted document with ID {$result->getInsertedId()}";
?>

<a href="index.php">Go back</a>

