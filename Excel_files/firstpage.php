<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Import contacts list or providers list</h2>

        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <div class="options">
                <label>
                    <input type="checkbox" name="option1" value="option1"> Contact list
                </label>
                <label>
                    <input type="checkbox" name="option2" value="option2"> providers list
                </label>
            </div>
            <button type="submit" name="submit">Upload File</button>
        </form>

        <?php
        // Check if form was submitted
        if (isset($_POST['submit'])) {
            $target_dir = "uploads/"; // Directory where uploaded files will be stored
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Full path of uploaded file

            // Try to upload file
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "<p class='success'>The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.</p>";
            } else {
                echo "<p class='error'>Sorry, there was an error uploading your file.</p>";
            }
        }
        ?>
    </div>
</body>
</html>