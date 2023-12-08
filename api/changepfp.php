<?php include("../base/conn.php"); ?>

<?php
function isImage($file) {
    $allowedMimeTypes = ['image/jpeg', 'image/png'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file);
    finfo_close($finfo);
    return in_array($mime, $allowedMimeTypes);
}

if (isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])) {
    $user = $_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"];

    $stmt = $pdo->prepare('SELECT id FROM accounts WHERE uscid=?');
    $stmt->execute([$user]);

    foreach ($stmt as $row) {
        $id = $row["id"];
    }
} else {
    header("Location: /login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Check if the file is an image and has a valid extension
    $allowedExtensions = ['jpg', 'png', 'jpeg'];
    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($fileExtension, $allowedExtensions) && isImage($_FILES['image']['tmp_name'])) {
        // Generate a unique name for the image file
        $filename = $id . '.png';
        $targetPath = '../assets/uspfp/' . $filename;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            echo 'Image uploaded successfully!';
            header("Location: /settings");
            exit();
        } else {
            echo 'Error uploading the image.';
        }
    } else {
        echo 'Invalid file format. Please upload a JPG, PNG, or JPEG image.';
    }
}
?>
