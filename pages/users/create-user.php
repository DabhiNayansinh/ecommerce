<?php include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php'; ?>

<?php
// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
//     header('location: login-form.php');
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registration Page</title>
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
    <h3 class="text-center">User Registration Form</h3>
    <div class="container">
        <form class="row g-3 needs-validation" id="myForm" action="register.php" method="POST"
            enctype="multipart/form-data">

            <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username"
                    placeholder="please enter your name">
                <div class="valid-feedback">Looks good!</div>
                <div id="usernameError" class="invalid-feedback" style="display: block;"></div>
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4"
                    placeholder="please enter your email">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword4"
                    placeholder="please enter your password">
            </div>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="inputEmail4" placeholder="">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" id="inputPassword4">
            </div>

            <div class="col-12">
                <label for="inputAddress" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">Country</label>
                <select name="country" id="country" class="form-control" required>
                    <option value="">Select Country</option>
                    <?php
                    // Fetch countries from database
                    $result = mysqli_query($conn, "SELECT * FROM countries");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select name="state" id="state" class="form-control" required>
                    <option value="">Select State</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">City</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="">Select City</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">Pincode</label>
                <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>

            <!-- <div class="col-md-2">
              <label for="inputZip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="inputZip">
            </div> -->

            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="address_line1" class="form-control" id="inputAddress"
                    placeholder="1234 Main St">
            </div>

            <div class="col-12">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" name="address_line2" class="form-control" id="inputAddress2"
                    placeholder="Apartment, studio, or floor">
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck"> Check me out </label>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>

        <script>
            // AJAX to fetch states based on selected country
            $('#country').change(function () {
                var countryId = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'get_states.php',
                    data: { country_id: countryId },
                    success: function (data) {
                        $('#state').html(data);
                        $('#city').html('<option value="">Select City</option>'); // Reset city dropdown
                    }
                });
            });

            // AJAX to fetch cities based on selected state
            $('#state').change(function () {
                var stateId = $(this).val();
                var countryId = $('#country').val();
                $.ajax({
                    type: 'POST',
                    url: 'get_cities.php',
                    data: { state_id: stateId, country_id: countryId },
                    success: function (data) {
                        $('#city').html(data);
                    }
                });
            });
        </script>
    </div>
</body>

</html>