<?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php'; ?>

<?php
/*if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: login-form.php');
    exit;
}*/
?>
<?php // include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/includes/header.php'; ?>
<?php // include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/includes/sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add New Product</title>
    <style>
        .text-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h3 class="text-center">Add New Product</h3>
    <div class="container">
        <form class="row g-3 needs-validation" id="myForm" action="products-create.php" method="POST" enctype="multipart/form-data">
        
        <div class="col-md-4">
                <label for="inputState" class="form-label">Category</label>
                <select name="category_id" id="Category" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php
                        // Fetch countries from database
                        $result = mysqli_query($conn, "SELECT * FROM categories");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="col-12">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="please enter your product name">
                <div class="valid-feedback">Looks good!</div>
                <div id="productnameError" class="invalid-feedback" style="display: block;"></div>
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Brand</label>
                <input type="text" name="brand" class="form-control" id="inputEmail4" placeholder="please enter your brand">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="inputPassword4" placeholder="please enter your description">
            </div>
        
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Sale Price</label>
                <input type="text" name="price" class="form-control" id="inputEmail4"placeholder="">
            </div>
            
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Discount</label>
                <input type="text" name="discount" class="form-control" id="inputPassword4">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Quentity</label>
                <input type="text" name="stock_quantity" class="form-control" id="inputPassword4">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">
                    Select Your Size
                </label>
                <input type="text" name="size" class="form-control" id="inputPassword4">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">
                    Select Colors
                </label>
                <input type="text" name="colors" class="form-control" id="inputPassword4">
            </div>
            
            <div class="col-12">
                <label for="inputAddress" class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>

            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">Save As Draft</button>
                <button type="submit" name="submit" class="btn btn-primary">Publish</button>
                <button type="reset" class="btn btn-primary">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php // include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/includes/footer.php'; ?>
