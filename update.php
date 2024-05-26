<?php
require_once 'connection.php';
$collection = $db->flori;

$updateResult = $collection->updateOne(
    ['nume' => 'rose'],
    ['$set' => ['nume' => 'lalele']]
);

echo "Matched {$updateResult->getMatchedCount()} document(s)\n";
echo "Modified {$updateResult->getModifiedCount()} document(s)\n";
?>

<a href="index.php">Go back</a>
