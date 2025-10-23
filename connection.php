<?php
    error_reporting(0);
    // session_start();
    $conn=mysqli_connect("localhost", "root", "", "ecommrce");
    if(mysqli_connect_errno()) {
        echo "Connection Faield".mysqli_connect_error();
    }

function uploadFile($file, $targetDir, $allowedExtensions = [], $maxFileSize = 5000000) {
    // Ensure the target directory exists and is writable
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
    }

    // Check if a file is uploaded
    if (isset($file) && $file['error'] == 0) {
        // Get file details
        $fileName = basename($file["name"]);
        $targetFile = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // ✅ Check if file size exceeds the limit (default: 5MB)
        if ($file["size"] > $maxFileSize) {
            die("Sorry, your file is too large.");
        }

        // ✅ Check if the file type is allowed (if provided)
        if (!empty($allowedExtensions) && !in_array($fileType, $allowedExtensions)) {
            die("Sorry, only the following file types are allowed: " . implode(", ", $allowedExtensions));
        }

        // ✅ Move the uploaded file to the target directory
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Return the file name for storing in the database
            return $fileName;
        } else {
            die("Sorry, there was an error uploading your file.");
        }
    } else {
        // No file uploaded, return null
        return null;
    }
}


?>