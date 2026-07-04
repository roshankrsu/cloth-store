<?php
include '../config/admin_auth.php';
include '../config/database.php';
include '../includes/header.php';
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Admin Panel</h2>
                    <p class="mb-0">Add New Product</p>
                </div>

                <div class="card-body">

                    <?php if (isset($_GET['success'])) { ?>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Product added successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>

                    <?php } ?>

                    <form action="save_product.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input
                                type="text"
                                name="product_name"
                                class="form-control"
                                placeholder="Enter Product Name"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                                placeholder="Enter Product Description"
                                required></textarea>
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="form-label">Price (₹)</label>
                                    <input
                                        type="number"
                                        name="price"
                                        step="0.01"
                                        min="0"
                                        class="form-control"
                                        placeholder="Enter Price"
                                        required>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input
                                        type="number"
                                        name="stock"
                                        min="1"
                                        class="form-control"
                                        placeholder="Available Quantity"
                                        required>
                                </div>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Category</label>

                            <select
                                name="category_id"
                                class="form-select"
                                required>

                                <option value="">Select Category</option>

                                <?php

                                $result = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_name");

                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <option value="<?= $row['id']; ?>">
                                        <?= htmlspecialchars($row['category_name']); ?>
                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">Product Image</label>

                            <input
                                type="file"
                                name="image"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                                required>

                            <small class="text-muted">
                                Allowed formats: JPG, JPEG, PNG, WEBP
                            </small>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="dashboard.php" class="btn btn-secondary">
                                ← Dashboard
                            </a>

                            <button
                                type="submit"
                                class="btn btn-success">

                                ➕ Add Product

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include '../includes/footer.php';
?>