<?php

    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['save_exel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    //validation part

    $allowed_ex = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ex)) {


    } 
    else 
    {
        $_SESSION['message'] = 'Invalid File';
        header('Location: homepage.php');
        exit(0);
    }
    


}