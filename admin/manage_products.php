<?php
include '../config/admin_auth.php';
include '../config/database.php';
include '../includes/header.php';
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Products</h2>

        <a href="add_product.php" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </div>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th width="180">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    $sql = "SELECT p.*, c.category_name
                            FROM products p
                            LEFT JOIN categories c
                            ON p.category_id = c.id
                            ORDER BY p.id DESC";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <tr>

                                <td><?= $row['id'] ?></td>

                                <td>

                                    <img
                                        src="../assets/images/products/<?= htmlspecialchars($row['image']) ?>"
                                        width="80"
                                        class="rounded">

                                </td>

                                <td><?= htmlspecialchars($row['product_name']) ?></td>

                                <td><?= htmlspecialchars($row['category_name']) ?></td>

                                <td>₹<?= number_format($row['price'], 2) ?></td>

                                <td><?= $row['stock'] ?></td>

                                <td>

                                    <a
                                        href="edit_product.php?id=<?= $row['id'] ?>"
                                        class="btn btn-primary btn-sm">

                                        <i class="bi bi-pencil-square"></i> Edit

                                    </a>

                                    <a
                                        href="delete_product.php?id=<?= $row['id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this product?');">

                                        <i class="bi bi-trash"></i> Delete

                                    </a>

                                </td>

                            </tr>

                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No products found.</td></tr>";
                    }

                    ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>