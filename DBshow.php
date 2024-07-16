<?php

$servername = "localhost";
$username = "admin";
$password = "password";
$dbname = "test_schema";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT first_name, last_name, phone_number, adress, email FROM contacts";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data from Database</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data from Database</h1>
    <table>
        <tr>
            <th>first name</th>
            <th>last name</th>
            <th>phone number</th>
            <th>adress</th>
            <th>email</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["first_name"]. "</td><td>" . $row["last_name"]. "</td><td>" . $row["phone_number"]. "</td><td>"
                . $row["adress"]. "</td><td>" . $row["email"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>