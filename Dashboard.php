<?php
// include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';
// include 'connection.php'; 

$username = $_SESSION['username'] ?? 'Guest';

?>
<?php include 'includes/header.php'; ?>
<div class="d-flex">
    <!-- Sidebar Wrapper -->
    <nav class="sidebar-wrapper">
        <?php include 'includes/sidebar.php'; ?>
    </nav>
    <div class="container-fluid p-4">
        <h2>Welcome <?php echo htmlspecialchars($username); ?></h2>
        <p>This is the main dashboard of the website.</p>

        <div class="row">
            <div class="col-md-6">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Manage users of the website.</p>
                        <a href="/ecommerce/ecommerce/pages/users/users-listing.php" class="btn btn-light">Go to
                            Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">Manage available products.</p>
                        <a href="/ecommerce/ecommerce/pages/products/products-listing.php" class="btn btn-light">Go to
                            Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>