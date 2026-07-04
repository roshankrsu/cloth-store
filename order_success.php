<?php
include 'config/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';

$order_id = $_GET['id'] ?? '';
?>

<div class="container mt-5">

    <div class="card shadow text-center">

        <div class="card-body p-5">

            <h1 class="text-success">
                ✅ Order Placed Successfully
            </h1>

            <p class="lead">
                Thank you for shopping with us.
            </p>

            <h4>
                Order ID:
                #<?= htmlspecialchars($order_id) ?>
            </h4>

            <a
                href="products.php"
                class="btn btn-primary mt-4">

                Continue Shopping

            </a>

            <a
                href="my_orders.php"
                class="btn btn-success mt-4">

                My Orders

            </a>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>