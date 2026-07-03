<?php
include 'config/auth.php';
include 'config/database.php';
include 'includes/header.php';
include 'includes/navbar.php';

$user_id = $_SESSION['user']['id'];

$sql = "SELECT
            cart.id,
            cart.quantity,
            products.product_name,
            products.price,
            products.image
        FROM cart
        INNER JOIN products
        ON cart.product_id = products.id
        WHERE cart.user_id=?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$total = 0;
?>

<div class="container mt-5">

    <h2 class="mb-4">🛒 Shopping Cart</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <?php while ($row = mysqli_fetch_assoc($result)) {

                    $itemTotal = $row['price'] * $row['quantity'];
                    $total += $itemTotal;

                ?>

                    <tr>

                        <td width="120">

                            <img
                                src="assets/images/products/<?= htmlspecialchars($row['image']) ?>"
                                class="img-fluid rounded">

                        </td>

                        <td><?= htmlspecialchars($row['product_name']) ?></td>

                        <td>₹<?= number_format($row['price'], 2) ?></td>

                        <td><?= $row['quantity'] ?></td>

                        <td>₹<?= number_format($itemTotal, 2) ?></td>

                        <td>

                            <a
                                href="remove_cart.php?id=<?= $row['id'] ?>"
                                class="btn btn-danger btn-sm">

                                Remove

                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

        <div class="text-end">

            <h3>

                Grand Total :
                ₹<?= number_format($total, 2) ?>

            </h3>

            <a
                href="checkout.php"
                class="btn btn-success btn-lg">

                Proceed to Checkout

            </a>

        </div>

    <?php } else { ?>

        <div class="alert alert-warning">

            Your cart is empty.

        </div>

    <?php } ?>

</div>

<?php include 'includes/footer.php'; ?>