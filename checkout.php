<?php
include 'config/auth.php';
include 'config/database.php';
include 'includes/header.php';
include 'includes/navbar.php';

$user_id = $_SESSION['user']['id'];

$sql = "SELECT cart.quantity,
               products.product_name,
               products.price
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

    <h2 class="mb-4">Checkout</h2>

    <form action="place_order.php" method="POST">

        <div class="row">

            <!-- Shipping Details -->
            <div class="col-md-6">

                <div class="card shadow mb-4">

                    <div class="card-header bg-primary text-white">
                        Shipping Details
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="shipping_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pincode</label>
                            <input type="text" name="pincode" class="form-control" required>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Order Summary -->
            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-header bg-success text-white">
                        Order Summary
                    </div>

                    <div class="card-body">

                        <table class="table">

                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php while($row = mysqli_fetch_assoc($result)) {

                                    $itemTotal = $row['price'] * $row['quantity'];
                                    $total += $itemTotal;
                                ?>

                                <tr>

                                    <td><?= htmlspecialchars($row['product_name']) ?></td>

                                    <td><?= $row['quantity'] ?></td>

                                    <td>₹<?= number_format($itemTotal,2) ?></td>

                                </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                        <hr>

                        <h4 class="text-end">
                            Grand Total:
                            ₹<?= number_format($total,2) ?>
                        </h4>

                        <input type="hidden" name="total" value="<?= $total ?>">

                        <button type="submit" class="btn btn-success w-100 mt-3">
                            Place Order
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

<?php include 'includes/footer.php'; ?>