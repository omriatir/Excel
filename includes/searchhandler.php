<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    <h2>Search Results</h2>

    <?php
    // Database connection parameters
    $host = 'localhost';
    $username = 'admin';
    $password = 'password';
    $database = 'test_schema';

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process search query
    if (isset($_GET['search_query'])) {
        $search_query = $_GET['search_query'];

        // Prepare SQL statement
        $sql = "SELECT * FROM user_info WHERE name LIKE '%$search_query%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row['name'] . " - " . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No results found";
        }

        // Close connection
        $conn->close();
    }
    ?>  

    <a href="/search.php">Back to Search</a>
    <br>
    <a href="/homepage.php">Back to Add Users</a>
</body>
</html>
