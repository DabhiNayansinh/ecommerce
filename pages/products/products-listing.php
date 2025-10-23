<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

// Filters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category_filter = isset($_GET['category']) ? intval($_GET['category']) : 0;
$status_filter = isset($_GET['status']) ? $_GET['status'] : '1';
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sort_order = (isset($_GET['order']) && strtolower($_GET['order']) === 'desc') ? 'DESC' : 'ASC';

$allowed_sort = ['id', 'name', 'price', 'stock_quantity'];
if (!in_array($sort_column, $allowed_sort)) $sort_column = 'id';

$recordsPerPage = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $recordsPerPage;

$where = "WHERE 1=1";
if ($status_filter === '1') {
    $where .= " AND is_active = 1";
} elseif ($status_filter === '0') {
    $where .= " AND is_active = 0";
}

if ($search !== '') {
    $search_esc = mysqli_real_escape_string($conn, $search);
    $where .= " AND name LIKE '%$search_esc%'";
}

if ($category_filter > 0) {
    $where .= " AND category_id = $category_filter";
}

$total_records_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM products $where");
$total_records = mysqli_fetch_assoc($total_records_query)['total'];
$total_pages = ceil($total_records / $recordsPerPage);

$query = mysqli_query($conn, "SELECT * FROM products $where ORDER BY $sort_column $sort_order LIMIT $offset, $recordsPerPage");
$categories = mysqli_query($conn, "SELECT id, name FROM categories");

function sort_link($column, $label, $current_sort, $current_order, $params) {
    $order = 'asc';
    $arrow = '';
    if ($column === $current_sort) {
        if ($current_order === 'ASC') {
            $order = 'desc';
            $arrow = ' ▲';
        } else {
            $order = 'asc';
            $arrow = ' ▼';
        }
    }
    $params['sort'] = $column;
    $params['order'] = $order;
    $url = '?' . http_build_query($params);
    return "<a href=\"$url\">$label$arrow</a>";
}

$params = $_GET;
unset($params['page']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Product Listing with Export</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .container { margin-top: 40px; }
    table th, table td { vertical-align: middle; }
  </style>
</head>
<body>

<div class="container">
  <h2>Products</h2>
  <a href="products-add.php" class="btn btn-success mb-3">+ Add Product</a>

  <form method="GET" class="row g-3 mb-4 align-items-center">
    <div class="col-md-3">
      <input type="text" name="search" class="form-control" placeholder="Search by name..." value="<?php echo htmlspecialchars($search); ?>">
    </div>
    <div class="col-md-2">
      <select name="category" class="form-select">
        <option value="0">All Categories</option>
        <?php 
        mysqli_data_seek($categories, 0);
        while($cat = mysqli_fetch_assoc($categories)): ?>
          <option value="<?php echo $cat['id']; ?>" <?php if ($category_filter == $cat['id']) echo 'selected'; ?>>
            <?php echo htmlspecialchars($cat['name']); ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-2">
      <select name="status" class="form-select">
        <option value="" <?php if($status_filter==='') echo 'selected'; ?>>All</option>
        <option value="1" <?php if($status_filter==='1') echo 'selected'; ?>>Active</option>
        <option value="0" <?php if($status_filter==='0') echo 'selected'; ?>>Inactive</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary">Filter</button>
    </div>
    <div class="col-md-2">
      <button type="button" id="refreshBtn" class="btn btn-secondary">Refresh</button>
    </div>
  </form>

  <!-- Export Excel Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Product Listing</h5>
    <form method="post" action="/ecommerce/ecommerce/export/export-excel.php">
        <input type="hidden" name="table" value="products">
        <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
        <input type="hidden" name="category" value="<?php echo htmlspecialchars($category_filter); ?>">
        <input type="hidden" name="status" value="<?php echo htmlspecialchars($status_filter); ?>">
        <button type="submit" class="btn btn-outline-success btn-sm">Export to Excel</button>
    </form>
  </div>

  <!-- Table -->
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Image</th>
        <th><?php echo sort_link('name', 'Name', $sort_column, $sort_order, $params); ?></th>
        <th>Brand</th>
        <th>Category</th>
        <th><?php echo sort_link('price', 'Price', $sort_column, $sort_order, $params); ?></th>
        <th>Discount</th>
        <th><?php echo sort_link('stock_quantity', 'Stock', $sort_column, $sort_order, $params); ?></th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if (mysqli_num_rows($query) > 0): 
        mysqli_data_seek($categories, 0);
        $categories_assoc = [];
        while($c = mysqli_fetch_assoc($categories)) {
          $categories_assoc[$c['id']] = $c['name'];
        }
        $count = $offset + 1;
      ?>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
          <tr>
            <td><?php echo $count++; ?></td>
            <td>
              <?php if (!empty($row['image'])): ?>
                <img src="/ecommerce/ecommerce/uploads/<?php echo htmlspecialchars($row['image']); ?>" width="60" />
              <?php else: ?>No Image<?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['brand']); ?></td>
            <td><?php echo htmlspecialchars($categories_assoc[$row['category_id']] ?? 'N/A'); ?></td>
            <td>₹<?php echo htmlspecialchars($row['price']); ?></td>
            <td><?php echo htmlspecialchars($row['discount']); ?>%</td>
            <td><?php echo htmlspecialchars($row['stock_quantity']); ?></td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input toggle-active" type="checkbox" data-id="<?php echo $row['id']; ?>" <?php echo ($row['is_active'] ? 'checked' : ''); ?>>
              </div>
            </td>
            <td>
              <a href="products-view.php?viewId=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">View</a>
              <a href="products-edit.php?editId=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="products-delete.php?delId=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure to delete this product?');" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="10" class="text-center text-danger">No products found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <nav>
    <ul class="pagination justify-content-center">
      <?php if ($page > 1): ?>
        <li class="page-item"><a class="page-link" href="?<?php echo http_build_query(array_merge($params, ['page' => $page - 1])); ?>">&laquo; Prev</a></li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
          <a class="page-link" href="?<?php echo http_build_query(array_merge($params, ['page' => $i])); ?>"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <li class="page-item"><a class="page-link" href="?<?php echo http_build_query(array_merge($params, ['page' => $page + 1])); ?>">Next &raquo;</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.toggle-active').change(function(){
        var productId = $(this).data('id');
        var isActive = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: 'products-toggle-active.php',
            method: 'POST',
            data: { id: productId, is_active: isActive },
            success: function(response){
                console.log(response);
                location.reload();
            },
            error: function(){
                alert('Error updating status');
            }
        });
    });

    $('#refreshBtn').click(function(){
        window.location.href = window.location.pathname;
    });
});
</script>

</body>
</html>
