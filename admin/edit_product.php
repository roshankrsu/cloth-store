<?php
include '../config/auth.php';
include '../config/database.php';
include '../includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: manage_products.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Product not found.</div></div>";
    include '../includes/footer.php';
    exit;
}

$product = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h3>Edit Product</h3>
        </div>

        <div class="card-body">

            <form action="update_product.php" method="POST">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $product['id'] ?>">

                <div class="mb-3">

                    <label>Product Name</label>

                    <input
                        type="text"
                        name="product_name"
                        class="form-control"
                        value="<?= htmlspecialchars($product['product_name']) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="5"
                        required><?= htmlspecialchars($product['description']) ?></textarea>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <label>Price</label>

                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            class="form-control"
                            value="<?= $product['price'] ?>"
                            required>

                    </div>

                    <div class="col-md-6">

                        <label>Stock</label>

                        <input
                            type="number"
                            name="stock"
                            class="form-control"
                            value="<?= $product['stock'] ?>"
                            required>

                    </div>

                </div>

                <div class="mt-4">

                    <button
                        class="btn btn-success">

                        Update Product

                    </button>

                    <a
                        href="manage_products.php"
                        class="btn btn-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>