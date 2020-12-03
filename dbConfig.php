<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "codexworld";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


//$sql = "INSERT INTO members (Dokument, Kodtowaru, EAN, Nazwatowaru,
//Iloscdorealizacji, Jednostka, Cenauzgodniona, Waluta) VALUES ('1','2','3','4','5','6','7','8')";
//
//if (mysqli_query($db, $sql)) {
//    echo "New record created successfully !";
//} else {
//    echo "Error: " . $sql . "
//" . mysqli_error($db);
//}
//mysqli_close($db);

if (isset($_POST['importSubmit'])) {

    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

        // If the file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // Parse data from CSV file line by line
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                // Get row data
                $Dokument = $line[0];
                $Kod_towaru = $line[1];
                $EAN = $line[2];
                $Nazwa_towaru = $line[3];
                $Ilosc_do_realizacji = $line[4];
                $Jednostka = $line[5];
                $Cena_uzgodniona = $line[6];
                $Waluta = $line[7];
                $dbHost = "localhost";
                $dbUsername = "root";
                $dbPassword = "";
                $dbName = "codexworld";

// Create database connection
                $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
                if ($db->connect_error) {
                    die("Connection failed: " . $db->connect_error);
                }



                $sql = "INSERT INTO `members`(`Dokument`, `Kodtowaru`, `EAN`, `Nazwatowaru`, `Iloscdorealizacji`, `Jednostka`, `Cenauzgodniona`, `Waluta`) 
VALUES ('$Dokument','$Kod_towaru','$EAN','$Nazwa_towaru','$Ilosc_do_realizacji','$Jednostka','$Cena_uzgodniona','$Waluta')";

                if (mysqli_query($db, $sql)) {
                    echo "New record created successfully !";
                } else {
                    echo "Error: " . $sql . "
" . mysqli_error($db);
                }
                mysqli_close($db);
//                if ($database->connect_error) {
//                    die("Connection failed: " . $database->connect_error);
//                }
//
//                $sql = "INSERT INTO members (Dokument, Kodtowaru, EAN, Nazwatowaru,
//Iloscdorealizacji, Jednostka, Cenauzgodniona, Waluta) VALUES ('.$Dokument.', '.$Kod_towaru.',
// '.$EAN.', '.$Nazwa_towaru.',  '.$Jednostka.',
// '.$Cena_uzgodniona.',
// '.$Waluta.')";
//
//                if (mysqli_query($database, $sql)) {
//                    echo "New record created successfully !";
//                } else {
//                    echo "Error: " . $sql . "
//" . mysqli_error($database);
//                }
//                mysqli_close($database);

                // Database configuration



//

            }
        }


        // Close opened CSV file
        fclose($csvFile);

        $qstring = '?status=succ';


    } else {
        $qstring = '?status=err';
    }
} else {
    $qstring = '?status=invalid_file';


}
// Redirect to the listing page
//header("Location: index.php" . $qstring);