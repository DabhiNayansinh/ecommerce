<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if (!isset($_POST['table'])) {
    die("No table specified.");
}

$table = mysqli_real_escape_string($conn, $_POST['table']);
$filename = $table . "_export_" . date("Y-m-d") . ".xls";

// Fetch data
$query = "SELECT * FROM `$table` WHERE is_active = 1";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error exporting: " . mysqli_error($conn));
}

// Send headers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");

$sep = "\t";

// Column names
$fields = mysqli_fetch_fields($result);
foreach ($fields as $field) {
    echo $field->name . $sep;
}
echo "\n";

// Rows
while ($row = mysqli_fetch_assoc($result)) {
    $line = '';
    foreach ($row as $value) {
        $value = str_replace(["\t", "\n"], ["\\t", "\\n"], $value);
        $line .= $value . $sep;
    }
    echo trim($line) . "\n";
}

exit;
?>
