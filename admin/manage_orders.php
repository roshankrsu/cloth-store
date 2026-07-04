<?php
include '../config/auth.php';
include '../config/database.php';
include '../includes/header.php';
?>

<div class="container mt-5">

    <h2 class="mb-4">Manage Orders</h2>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>Order ID</th>
                        <th>Customer ID</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    $result = mysqli_query(
                        $conn,
                        "SELECT * FROM orders ORDER BY order_date DESC"
                    );

                    while ($row = mysqli_fetch_assoc($result)) {

                    ?>

                        <tr>

                            <td>#<?= $row['id'] ?></td>

                            <td><?= $row['user_id'] ?></td>

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
                                    href="view_order.php?id=<?= $row['id'] ?>"
                                    class="btn btn-primary btn-sm">

                                    View

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>