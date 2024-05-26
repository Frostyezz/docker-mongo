<?php
require_once 'connection.php';
$collection = $db->flori;

$deleteResult = $collection->deleteOne(['nume' => 'lalele']);

echo "Deleted {$deleteResult->getDeletedCount()} document(s)\n";
?>

<a href="index.php">Go back</a>
