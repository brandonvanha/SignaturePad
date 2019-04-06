<?php

if (isset($_POST['imageData'])) {
    $imgData = base64_decode($_POST['imageData']);
  
    // Path where the image is going to be saved
    $filePath = guidv4().'.png';

    // Delete previously uploaded image
    // if (file_exists($filePath)) { unlink($filePath); }

    // Write $imgData into the image file
    $file = fopen($filePath, 'w');
    fwrite($file, $imgData);
    fclose($file);
} else {
    echo "imageData doesn't exists";
}

function guidv4() {
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');

    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

?>