<!doctype html>
<html lang="en">
    <?php
    	include('connection.php');
        $viewId=$_GET['viewId'];
        $query = mysqli_query($conn,"select id,name,is_active,created_on,created_by,modify_on,modify_by from categories where id = $viewId ");
            while ($row=mysqli_fetch_array($query)) {
    ?>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<title>categories-view</title>
	</head>
	<body>
		<form>
			<div class="container">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Categories Name</span>
                    <input class="form-control" value="<?php echo $row['name']; ?>" readonly>
                </div>
		
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Active</span>
                    <input class="form-control" value="<?php echo $row['is_active']; ?>" readonly>
				</div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Created ON</span>
                    <input class="form-control" value="<?php echo $row['created_on']; ?>" readonly>
				</div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Created BY</span>
					<input class="form-control" value="<?php echo $row['created_by']; ?>" readonly>
				</div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Modify ON</span>
					<input class="form-control" value="<?php echo $row['modify_on']; ?>" readonly>
				</div>
			
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Modify BY</span>
					<input class="form-control" value="<?php echo $row['modify_by']; ?>" readonly>
				</div>
				<button type="submit" name="submit" class="btn btn-success" disabled>Submit</button>
			</div>
		</form>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	</body>
    <?php } ?>
</html>