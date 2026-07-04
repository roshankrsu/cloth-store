<?php
include '../config/admin_auth.php';
include '../config/database.php';
include '../includes/header.php';

$productCount = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM products"))[0];
$orderCount = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM orders"))[0];
$userCount = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];
$categoryCount = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM categories"))[0];
?>

<div class="container mt-5">

    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow border-primary">
                <div class="card-body">
                    <h1><?= $productCount ?></h1>
                    <h5>Products</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow border-success">
                <div class="card-body">
                    <h1><?= $orderCount ?></h1>
                    <h5>Orders</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow border-warning">
                <div class="card-body">
                    <h1><?= $userCount ?></h1>
                    <h5>Users</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card text-center shadow border-danger">
                <div class="card-body">
                    <h1><?= $categoryCount ?></h1>
                    <h5>Categories</h5>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow">

        <div class="card-header bg-dark text-white">
            Quick Actions
        </div>

        <div class="card-body">

            <a href="add_product.php" class="btn btn-success m-2">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>

            <a href="manage_products.php" class="btn btn-primary m-2">
                <i class="bi bi-box"></i> Manage Products
            </a>

            <a href="manage_orders.php" class="btn btn-warning m-2">
                <i class="bi bi-receipt"></i> Manage Orders
            </a>

            <a href="manage_users.php" class="btn btn-info m-2">
                <i class="bi bi-people"></i> Manage Users
            </a>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>