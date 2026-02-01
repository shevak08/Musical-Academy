<?php
// PHP code remains unchanged
$upload_success = null;
$delete_message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && isset($_POST['action']) && $_POST['action'] === 'upload' && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "uploads/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }

        $file_name = basename($_FILES["file"]["name"]);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
            $upload_success = "File uploaded successfully!";
        } else {
            $upload_success = "There was an error uploading the file.";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['file_name'])) {
        $file_to_delete = "uploads/" . $_POST['file_name'];

        if (file_exists($file_to_delete)) {
            if (unlink($file_to_delete)) {
                $delete_message = "File deleted successfully!";
            } else {
                $delete_message = "Error deleting the file.";
            }
        } else {
            $delete_message = "File does not exist.";
        }
    }
}

// Safely handle uploaded files
$upload_dir = "uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true); // Create the directory if missing
}
$uploaded_files = is_dir($upload_dir) ? array_diff(scandir($upload_dir), array('.', '..')) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <style>
        body {
            background-image: url('pic.avif');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: black;
            text-align: center;
        }
        h1 {
            margin-top: 50px;
        }
        label, input, button {
            display: block;
            margin: 10px auto;
            font-size: 18px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .delete-button {
            background-color: #FF4136;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 5px;
        }
        .delete-button:hover {
            background-color: #D32F2F;
        }
        .success, .error {
            font-size: 20px;
            margin-top: 20px;
        }
        .success { color: green; }
        .error { color: red; }
        .gallery {
            margin-top: 50px;
        }
        .gallery div {
            text-align: center;
            margin: 10px 0;
        }
        .gallery img {
            max-width: 150px;
            margin: 10px auto;
            border: 2px solid #black;
            border-radius: 10px;
            display: block;
        }
    </style>
</head>
<body>
    <h1>Upload Your File</h1>
    <form action="" method="post" style="margin-top: 50px;
            background-color: rgba(71, 99, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;" enctype="multipart/form-data">
        <input type="hidden" name="action" value="upload">
        <label for="file">Choose file to upload:</label>
        <input type="file" id="file" name="file" accept="*/*"><br><br>
        <button type="submit">Upload</button>
    </form>

    <?php if (!is_null($upload_success)): ?>
        <p class="<?= strpos($upload_success, 'successfully') !== false ? 'success' : 'error'; ?>">
            <?= $upload_success; ?>
        </p>
    <?php endif; ?>
    <?php if (!is_null($delete_message)): ?>
        <p class="<?= strpos($delete_message, 'successfully') !== false ? 'success' : 'error'; ?>">
            <?= $delete_message; ?>
        </p>
    <?php endif; ?>

    <div class="gallery">
        <h2>Uploaded Files:</h2>
        <?php foreach ($uploaded_files as $file): ?>
            <?php $file_path = "uploads/" . $file; ?>
            <div>
                <?php if (@getimagesize($file_path)): ?>
                    <!-- Display as an image if the file is an image -->
                    <img src="<?= $file_path ?>" alt="<?= $file ?>">
                <?php else: ?>
                    <!-- Display as a link if not an image -->
                    <a href="<?= $file_path ?>" target="_blank"><?= $file ?></a>
                <?php endif; ?>
            </div>
            <div>
                <form action="" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="file_name" value="<?= $file ?>">
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
