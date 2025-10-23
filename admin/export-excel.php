<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if (isset($_POST['table'])) {
    $table = $_POST['table'];

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename={$table}_" . date("Ymd_His") . ".xlsx");

    $result = mysqli_query($conn, "SELECT * FROM `$table` WHERE is_active = 1");

    $firstRow = true;

    echo "<table border='1'>";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($firstRow) {
            echo "<tr>";
            foreach ($row as $key => $val) {
                echo "<th>" . htmlspecialchars($key) . "</th>";
            }
            echo "</tr>";
            $firstRow = false;
        }

        echo "<tr>";
        foreach ($row as $val) {
            echo "<td>" . htmlspecialchars($val) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>
