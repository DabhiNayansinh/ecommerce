<?php
// header.php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';
$username = $_SESSION['username'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="/ecommerce/assets/favicon.ico" type="image/x-icon" />
    <title>My eCommerce Admin</title>
    <style>
        /* Sidebar toggle button style */
        #sidebarToggleBtn {
            border: none;
            background: transparent;
            color: white;
            font-size: 1.25rem;
            cursor: pointer;
            margin-right: 1rem;
        }

        /* Sidebar width & visibility */
        .sidebar-wrapper {
            width: 250px;
            transition: width 0.3s ease;
        }
        body.sidebar-collapsed .sidebar-wrapper {
            width: 0;
            overflow: hidden;
        }

        /* Adjust main content margin accordingly */
        .content-wrapper {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        body.sidebar-collapsed .content-wrapper {
            margin-left: 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Sidebar toggle button -->
        <button id="sidebarToggleBtn" aria-label="Toggle Sidebar">&#9776;</button>

        <a class="navbar-brand" href="index.php">My Project</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div>Welcome, <?php echo htmlspecialchars($username); ?></div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(function(){
        const $btn = $('#sidebarToggleBtn');
        $btn.on('click', function(){
            $('body').toggleClass('sidebar-collapsed');

            // Save state in localStorage to persist across pages
            if($('body').hasClass('sidebar-collapsed')){
                localStorage.setItem('sidebar-collapsed', 'true');
            } else {
                localStorage.removeItem('sidebar-collapsed');
            }
        });

        // On page load, apply saved sidebar state
        if(localStorage.getItem('sidebar-collapsed') === 'true'){
            $('body').addClass('sidebar-collapsed');
        }
    });
</script>
