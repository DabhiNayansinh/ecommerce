<!doctype html>
<html lang="en">
	<?php
        include('connection.php');
        $editId=$_GET['editId'];
        $query = mysqli_query($conn,"select name from categories where id = $editId ");
            while ($row=mysqli_fetch_array($query)) {
	?>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<title>categories-update</title>
	</head>
	<body>
		<form action="categories-update.php" method="POST">
			<div class="container">
				<div class="mb-3">
					<label for="exampleFormControlInput1" class="form-label">Categories Name</label>
					<input type="hidden" name="editId" value="<?php echo $editId ?>">
					<input type="text" name="categories-name" value="<?php echo $row['name']; ?>" class="form-control" id="exampleFormControlInput1">
				</div>
				<button type="submit" name="submit" class="btn btn-success">Submit</button>
			</div>
		</form>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	</body>
    <?php } ?>
</html>