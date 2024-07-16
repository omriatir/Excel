<!-- under me should be a part that connects this page to other pages session, i need to learn more about sessions -->


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Contact Form</title>
<link rel="stylesheet" href="styles_hp.css"/> <!-- Link to external CSS file -->
</head>
<body>

<div class="form-container">
    <h2>Contact Us</h2>
    <form action="includes/formhandler.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required/>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required/>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <div class="form-group">
            <label for="uploadfile">Upload file:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div class="form-group">
            <button type="submit" name="save_excel_data">Submit</button>
        </div>
    </form>

</div>

<!-- this below part of code is for presenting the error message if the file we uploaded is not in valid type -->

<?php 
if(isset($_SESSION['message'])){
    echo "<h4>".$_SESSION['message']."</h4>";
    unset($_SESSION['message']);

}
?>

</body>
</html>