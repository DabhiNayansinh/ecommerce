<?php include 'includes/header.php'; ?>
<div class="d-flex">
    <?php include 'includes/sidebar.php'; ?>
    <div class="container-fluid p-4">
        <h2>Welcome to My PHP Project</h2>
        <p>This is the main dashboard of the website.</p>

        <div class="row">
            <div class="col-md-6">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Manage users of the website.</p>
                        <a href="pages/users.php" class="btn btn-light">Go to Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">Manage available products.</p>
                        <a href="pages/products.php" class="btn btn-light">Go to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
