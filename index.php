<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <p>Total uploaded images: <span><?php echo isset($_SESSION['imageCount']) ? $_SESSION['imageCount'] : 0; ?></span></p>
        <a href="insert.php">Insert a record</a><br/><br/>
        <a href="update.php">Update a record</a><br/><br/>
        <a href="delete.php">Delete a record</a><br/><br/>
        <a href="upload.php">Upload an image</a><br/><br/>
            <?php
            require_once 'connection.php';

            $collection1 = $db->images;
            $collection2 = $db->flori;

            $cursor = $collection2->find();

            foreach ($cursor as $document) {
                echo $document['nume'] . ' - ' . $document['culoare'] . ' - ' . $document['marime'] . ' - ' . $document['pret'] . '<br/>';
            }

            $cursor = $collection1->find();
            echo '<div class="row mt-5">';
            foreach ($cursor as $document) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($document['data']->getData()) . '" class="card-img-top img-fluid" alt="' . $document['filename'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $document['filename'] . '</h5>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            ?>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
