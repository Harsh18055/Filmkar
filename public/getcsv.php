<?php


// $fileContents = file_get_contents('file.txt');
// $array = json_decode($fileContents, true);
// $fileValue = $array['SOAP-ENV_Body']['ns1_GetStockFileResponse']['ns1_File'];

$fileContents = file_get_contents('https://digitalbhuro.com/assets/setting/demo.txt');
if (preg_match('/\[ns1_File\] => ([^,]+)/', $fileContents, $matches)) {
    $ns1_File = $matches[1];
    // echo $ns1_File; 
}


$string = base64_decode($ns1_File);

$rows = explode("\n", $string);

// Open a new file for writing
$file = fopen("assets/setting/file.csv", "w");

// Loop through the array and write each row to the file
foreach ($rows as $row) {
    // Convert the row to an array
    $data = explode(",", $row);
    echo $row;
    // Write the row to the file
    fputcsv($file, $data);
}

// Close the file
fclose($file);
?>