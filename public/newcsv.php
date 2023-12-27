<?php

// Connect to the database
$servername = "localhost";
$username = "u503668574_csv";
$password = "IylCbM]?4/";
$dbname = "u503668574_csv";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Create a new table
// $sql = "CREATE TABLE mytable (
//         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         StockLevel VARCHAR(30) NOT NULL
//     )";
// mysqli_query($conn, $sql);

// Read CSV file and insert values into the new table
if (($handle = fopen("assets/setting/file.csv", "r")) !== FALSE) {
    $skip = true; // Skip the first row (header)
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($skip) {
            $skip = false;
            continue;
        }
        $firstname = mysqli_real_escape_string($conn, $data[2]);
        $sql = "INSERT INTO mytable (StockLevel) VALUES ('$firstname')";
        mysqli_query($conn, $sql);
    }
    fclose($handle);
}

// Close the database connection
mysqli_close($conn);

?>
