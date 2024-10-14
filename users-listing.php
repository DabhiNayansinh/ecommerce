<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Categories Listing</title>
    <style>
        /* Center the table */
        .table-container {
        margin : 100px 0px 0px 0px;
        }
    </style>
</head>
<body>
	<a href="categories-add.html" class="btn btn-primary">Add Category</a>
    <div class="container">
        <div class="table-container">
            <table class="table table-hover table-bordered border-primary border">
                <thead class="table-dark">
                    <tr>
                        <th>SR NO</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Phone Number</th>
                        <th>Mobile Number</th>
                        <th>Image</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Active</th>
                        <th>Created ON</th>
                        <th>Created BY</th>
                        <th>Modify ON</th>
                        <th>Modify BY</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include('connection.php');
                    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
                        header('location: login-form.php');
                        exit;
                    }
                    $count = 1;
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $recordsPerPage = 3;
                    $offset = ($page - 1) * $recordsPerPage;

                    $query = mysqli_query($conn, "SELECT id, username,email,password,phone_number,mobile_number,image,country_id,state_id,city_id, is_active, created_on, created_by, modify_on, modify_by FROM users WHERE is_active = 1 ORDER BY id DESC LIMIT $offset, $recordsPerPage");
                    $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE is_active = 1"));

                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['mobile_number']; ?></td>
                        <td><?php echo '<img src="./uploads/'.$row['image'] . '" alt="Image" style="width:100px;height:auto;"/>'; ?></td>
                        <td><?php echo $row['country_id']; ?></td>
                        <td><?php echo $row['state_id']; ?></td>
                        <td><?php echo $row['city_id']; ?></td>
                        <td><?php echo $row['is_active']; ?></td>
                        <td><?php echo $row['created_on']; ?></td>
                        <td><?php echo $row['created_by']; ?></td>
                        <td><?php echo $row['modify_on']; ?></td>
                        <td><?php echo $row['modify_by']; ?></td>
                        <td>
                            <a href="categories-view.php?viewId=<?php echo htmlentities($row['id']); ?>"><i class="btn btn-success">View</i></a>
                            <a href="categories-edit.php?editId=<?php echo htmlentities($row['id']); ?>"><i class="btn btn-primary">Edit</i></a>
                            <a href="categories-delete.php?delId=<?php echo htmlentities($row['id']); ?>" onclick="return confirm('Do you really want to Delete ?');"><i class="btn btn-danger">Delete</i></a>
                        </td>
                    </tr>
                    <?php 
                        $count++;
                        } 
                    } else { ?>
                    <tr>
                        <th style="text-align:center; color:red;" colspan="8">No Record Found</th>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                $total_pages = ceil($total_records / $recordsPerPage);

                // Previous button
                if ($page > 1) {
                    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                }

                // Page numbers
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
                }

                // Next button
                if ($page < $total_pages) {
                    echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                }
                ?>
            </ul>
        </nav>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </div>
</body>
</html>
