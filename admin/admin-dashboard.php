<?php
function fetchData($table)
{
    global $conn;
    $sql = "SELECT * FROM `$table` WHERE is_active = 1";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
function fetchCount($table)
{
    global $conn;
    $sql = "SELECT COUNT(*) as total FROM `$table` WHERE is_active = 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}
$modules = ['users', 'products', 'orders', 'order_items', 'payments', 'email_queue', 'product_categories'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            background: #343a40;
            min-height: 100vh;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 10px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        .card h2 {
            font-size: 2rem;
        }
    </style>
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/includes/header.php'; ?>

<div class="d-flex">
    <nav class="sidebar-wrapper">

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/includes/sidebar.php'; ?>
</nav>
    <div class="main-content">
        <h2 class="mb-4">Admin Dashboard - Export Data & Summary</h2>

        <!-- Total Count Cards -->
        <div class="row g-3 mb-5">
            <?php foreach ($modules as $module):
                $count = fetchCount($module);
                $title = ucfirst(str_replace('_', ' ', $module));
                ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-primary text-white h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $title ?></h5>
                            <h2 class="card-text"><?= $count ?></h2>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Tables and Export Buttons -->
        <?php foreach ($modules as $module): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <strong><?= ucfirst(str_replace('_', ' ', $module)) ?></strong>
                    <form method="post" action="export-excel.php" class="m-0">
                        <input type="hidden" name="table" value="<?= $module ?>">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Export Excel</button>
                    </form>
                </div>
                <div class="card-body p-2">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm mb-0">
                            <thead class="table-secondary">
                            <tr>
                                <?php
                                $rows = fetchData($module);
                                if (!empty($rows)):
                                    foreach (array_keys($rows[0]) as $col): ?>
                                        <th><?= htmlspecialchars($col) ?></th>
                                    <?php endforeach;
                                else: ?>
                                    <th>No data available</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($rows)): ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <?php foreach ($row as $value): ?>
                                            <td><?= htmlspecialchars($value) ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="100%" class="text-center">No records found</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
