<?php

session_start();

$servername = "localhost";
$username = "admin";
$password = "password";
$dbname = "test_schema";

// Create connection to my DB
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

require '/var/www/html/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/* function uploadworksheet($CandU,$CNO,$UO) {

    //..... all code

    if($CNO) {
        $contactsQuery = "INSERT IGNORE INTO contacts (first_name,last_name,phone_number,adress,email) 
        VALUES ('$firstName','$lastName','$phoneNumber','$adress','$email')";
    }

    elseif($CandU) {
        $deleteallQuery = "DELETE FROM contacts WHERE id>0";
        $contactsQuery = "INSERT INTO contacts (first_name,last_name,phone_number,adress,email) 
        VALUES ('$firstName','$lastName','$phoneNumber','$adress','$email')";

    }

    else {
        $contactsQuery = "UPDATE contacts SET first_name = '$firstName', last_name = '$lastName', 
        phone_number = '$phoneNumber', adress = '$adress' , email = '$email'
        WHERE first_name = '$firstName';"

}

}

*/

function mapheaders() {

    // map in fact between excel headers and DB headers

}

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['fileToUpload']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    //validation part

    $allowed_ex = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ex)) {

        $inputFileNamePath = $_FILES['fileToUpload']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $firstRow = true;

        foreach($data as $row) {

            if ($firstRow) {
                $firstRow = false;
                continue;
            }

            $firstName = mysqli_real_escape_string($conn,$row['0']);
            $lastName = mysqli_real_escape_string($conn,$row['1']);
            $phoneNumber = mysqli_real_escape_string($conn,$row['2']);
            $adress = mysqli_real_escape_string($conn,$row['3']);
            $email = mysqli_real_escape_string($conn,$row['4']);

            $contactsQuery = "INSERT IGNORE INTO contacts (first_name,last_name,phone_number,adress,email) 
            VALUES ('$firstName','$lastName','$phoneNumber','$adress','$email')";

            $result = mysqli_query($conn,$contactsQuery);
            $msg = true;

        }
    
        if(isset($msg)) {
            $_SESSION['message'] = 'Successfully Imported';
            
            //this is the part of the form submission manually to a DB

            $user_name = mysqli_real_escape_string($conn, $_POST["name"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $user_message = mysqli_real_escape_string($conn, $_POST["message"]);

            $sql = "INSERT INTO user_info (name, email, message) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                // Bind parameters to the prepared statement
                mysqli_stmt_bind_param($stmt, "sss", $user_name, $email, $user_message);

                // Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "New record created successfully";
                } else {
                    echo "Error executing query: " . mysqli_stmt_error($stmt);
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Error preparing query: " . mysqli_error($conn);
            }

            // Close connection
            mysqli_close($conn);
            header('Location: http://localhost/DBshow.php');
            exit(0);
        }

    }

    else {
        $_SESSION['message'] = 'Invalid File';
        header('Location: homepage.php');
        exit(0);
    }

}

?> 