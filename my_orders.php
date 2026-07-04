<?php
include 'config/auth.php';
include 'config/database.php';
include 'includes/header.php';
include 'includes/navbar.php';

$user_id = $_SESSION['user']['id'];

$sql = "SELECT * FROM orders
        WHERE user_id=?
        ORDER BY order_date DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<div class="container mt-5">

    <h2 class="mb-4">
        <i class="bi bi-box-seam"></i> My Orders
    </h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>#<?= $row['id'] ?></td>

                        <td>
                            ₹<?= number_format($row['total'], 2) ?>
                        </td>

                        <td>

                            <?php
                            if ($row['status'] == "Pending") {
                                echo "<span class='badge bg-warning text-dark'>Pending</span>";
                            } elseif ($row['status'] == "Delivered") {
                                echo "<span class='badge bg-success'>Delivered</span>";
                            } else {
                                echo "<span class='badge bg-danger'>Cancelled</span>";
                            }
                            ?>

                        </td>

                        <td>
                            <?= date("d M Y", strtotime($row['order_date'])) ?>
                        </td>

                        <td>

                            <a
                                href="order_details.php?id=<?= $row['id'] ?>"
                                class="btn btn-primary btn-sm">

                                View Details

                            </a>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    <?php } else { ?>

        <div class="alert alert-info">

            You haven't placed any orders yet.

        </div>

    <?php } ?>

</div>

<?php include 'includes/footer.php'; ?>