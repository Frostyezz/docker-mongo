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
        <h2>Upload image</h2>
        <form method="post" action="upload.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="file" class="form-label">Choose image:</label>
                <input type="file" class="form-control" id="file" name="file" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
require_once 'connection.php';
$collection = $db->images;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];

    if ($file["error"] == UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            echo "Error: Only JPG, PNG, and GIF files are allowed.";
            exit;
        }

        $data = file_get_contents($file["tmp_name"]);

        $document = [
            'filename' => $file["name"],
            'data' => new MongoDB\BSON\Binary($data, MongoDB\BSON\Binary::TYPE_GENERIC),
        ];

        $collection->insertOne($document);

        echo "File uploaded successfully.";

        if (!isset($_SESSION['imageCount'])) {
            $_SESSION['imageCount'] = 1;
        } else {
            $_SESSION['imageCount']++;
        }

    } else {
        echo "Error uploading file.";
    }
}
?>

<a href="index.php">Go back</a>
