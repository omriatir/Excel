<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Search Page</title>
    <link rel="stylesheet" href="styles_sp.css">
</head>
<body>
    <div class="container">
        <h1>Search Page</h1>
        <form action="includes/searchhandler.php" method="GET">
            <input type="text" name="search_query" placeholder="Enter a name..."/>
            <button type="submit">Search</button>
        </form>
    </div>
</body>
</html>