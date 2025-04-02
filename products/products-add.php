<?php// include('connection.php'); ?>

<?php
/*if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: login-form.php');
    exit;
}*/
?>

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
        <form class="row g-3 needs-validation" id="myForm" action="register.php" method="POST" enctype="multipart/form-data">

            <div class="col-12">
                <label for="productname" class="form-label">Product Name</label>
                <input type="text" name="productname" class="form-control" id="productname" placeholder="please enter your product name">
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
                <input type="text" name="sale_price" class="form-control" id="inputEmail4"placeholder="">
            </div>
            
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Discount</label>
                <input type="text" name="discount" class="form-control" id="inputPassword4">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">
                    Select Your Size
                </label>
                <input type="text" name="discount" class="form-control" id="inputPassword4">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">
                    Select Colors
                </label>
                <input type="text" name="discount" class="form-control" id="inputPassword4">
            </div>
            
            <div class="col-12">
                <label for="inputAddress" class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">Country</label>
                <select name="country" id="country" class="form-control" required>
                    <option value="">Select Country</option>
                    <?php
                        // Fetch countries from database
                        //$result = mysqli_query($conn, "SELECT * FROM countries");
                        //while ($row = mysqli_fetch_assoc($result)) {
                         //   echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        //}
                    ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">Category</label>
                <select name="state" id="state" class="form-control" required>
                    <option value="">Category State</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputState" class="form-label">City</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="">Select City</option>
                </select>
            </div>

            <!-- <div class="col-md-2">
              <label for="inputZip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="inputZip">
            </div> -->

            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">Save As Draft</button>
                <button type="submit" name="submit" class="btn btn-primary">Publish</button>
                <button type="reset" class="btn btn-primary">Cancel</button>
            </div>
        </form>

        <script>
            // AJAX to fetch states based on selected country
            $('#country').change(function() {
                var countryId = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'get_states.php',
                    data: { country_id: countryId },
                    success: function(data) {
                        $('#state').html(data);
                        $('#city').html('<option value="">Select City</option>'); // Reset city dropdown
                    }
                });
            });
            
            // AJAX to fetch cities based on selected state
            $('#state').change(function() {
                var stateId = $(this).val();
                var countryId = $('#country').val();
                $.ajax({
                    type: 'POST',
                    url: 'get_cities.php',
                    data: { state_id: stateId, country_id: countryId },
                    success: function(data) {
                        $('#city').html(data);
                    }
                });
            });
            </script>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
// JavaScript validation and AJAX submission
document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    let isValid = true; // Flag to track overall validity

    // Validate Username
    const username = document.getElementById('username');
    const errorMessage = document.getElementById('usernameError'); // Element to display error message
    const minLength = 3;
    const maxLength = 15;

    // Clear previous error message
    errorMessage.textContent = '';

    if (username.value.trim() === '') {
        username.classList.add('is-invalid');
        username.classList.remove('is-valid'); // Remove valid class
        errorMessage.textContent = 'Username is required.';
        isValid = false;
    } else if (username.value.length < minLength) {
        username.classList.add('is-invalid');
        username.classList.remove('is-valid'); // Remove valid class
        errorMessage.textContent = `Username must be at least ${minLength} characters long.`;
        isValid = false;
    } else if (username.value.length > maxLength) {
        username.classList.add('is-invalid');
        username.classList.remove('is-valid'); // Remove valid class
        errorMessage.textContent = `Username must be no more than ${maxLength} characters long.`;
        isValid = false;
    } else {
        username.classList.remove('is-invalid');
        username.classList.add('is-valid'); // Add valid class
    }

    // Validate City
    const city = document.getElementById('validationCustom03');
    if (city.value.trim() === '') {
        city.classList.add('is-invalid');
        city.classList.remove('is-valid'); // Remove valid class
        isValid = false;
    } else {
        city.classList.remove('is-invalid');
        city.classList.add('is-valid'); // Add valid class
    }

    // Validate State
    const state = document.getElementById('validationCustom04');
    if (state.value === '') {
        state.classList.add('is-invalid');
        state.classList.remove('is-valid'); // Remove valid class
        isValid = false;
    } else {
        state.classList.remove('is-invalid');
        state.classList.add('is-valid'); // Add valid class
    }

    // Validate Zip Code using regex
    const zipCode = document.getElementById('validationCustom05');
    const zipPattern = /^\d{5}$/; // Regex for US ZIP code
    if (!zipPattern.test(zipCode.value)) {
        zipCode.classList.add('is-invalid');
        zipCode.classList.remove('is-valid'); // Remove valid class
        isValid = false;
    } else {
        zipCode.classList.remove('is-invalid');
        zipCode.classList.add('is-valid'); // Add valid class
    }

   // If all fields are valid, submit the form via AJAX
   if (isValid) {
       submitForm();
   }
});

// AJAX Submission Function
function submitForm() {
   const xhr = new XMLHttpRequest();
   const url = 'your-server-endpoint'; // Replace with your server endpoint

   xhr.open("POST", url, true);
   xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

   xhr.onreadystatechange = function () {
       if (xhr.readyState === XMLHttpRequest.DONE) {
           const responseMessage = document.getElementById("responseMessage");
           if (xhr.status === 200) {
               responseMessage.innerHTML = "<p>Form submitted successfully!</p>";
           } else {
               responseMessage.innerHTML = "<p>Error submitting form!</p>";
           }
       }
   };

   const data = JSON.stringify({
       firstName: document.getElementById('validationCustom01').value,
       lastName: document.getElementById('validationCustom02').value,
       username: document.getElementById('validationCustomUsername').value,
       city: document.getElementById('validationCustom03').value,
       state: document.getElementById('validationCustom04').value,
       zip: document.getElementById('validationCustom05').value,
   });

   xhr.send(data);
}
</script>
</body>
</html>