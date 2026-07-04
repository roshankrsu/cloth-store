<?php
include 'config/database.php';
include 'includes/header.php';
include 'includes/navbar.php';

$search = $_GET['search'] ?? '';
?>

<div class="container mt-5">

    <h2 class="mb-4">
        <i class="bi bi-bag-fill"></i> Our Products
    </h2>

    <!-- Search Form -->
    <form method="GET" class="mb-4">

        <div class="row">

            <div class="col-md-10">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search products..."
                    value="<?= htmlspecialchars($search) ?>">

            </div>

            <div class="col-md-2">

                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Search
                </button>

            </div>

        </div>

    </form>

    <div class="row">

        <?php

        if ($search != "") {

            $sql = "SELECT p.*, c.category_name
                    FROM products p
                    LEFT JOIN categories c
                    ON p.category_id = c.id
                    WHERE p.product_name LIKE ?
                    ORDER BY p.id DESC";

            $stmt = mysqli_prepare($conn, $sql);

            $keyword = "%" . $search . "%";

            mysqli_stmt_bind_param($stmt, "s", $keyword);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

        } else {

            $sql = "SELECT p.*, c.category_name
                    FROM products p
                    LEFT JOIN categories c
                    ON p.category_id = c.id
                    ORDER BY p.id DESC";

            $result = mysqli_query($conn, $sql);
        }

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

        ?>

                <div class="col-md-4 mb-4">

                    <div class="card shadow h-100">

                        <img
                            src="assets/images/products/<?= htmlspecialchars($row['image']) ?>"
                            class="card-img-top product-image"
                            alt="<?= htmlspecialchars($row['product_name']) ?>">

                        <div class="card-body d-flex flex-column">

                            <h4>
                                <?= htmlspecialchars($row['product_name']) ?>
                            </h4>

                            <p class="text-muted">
                                <?= htmlspecialchars($row['category_name']) ?>
                            </p>

                            <p>
                                <?= htmlspecialchars($row['description']) ?>
                            </p>

                            <h5 class="text-success">
                                ₹<?= number_format($row['price'], 2) ?>
                            </h5>

                            <p>
                                Stock:
                                <?= (int)$row['stock'] ?>
                            </p>

                            <div class="mt-auto">

                                <a
                                    href="product.php?id=<?= $row['id'] ?>"
                                    class="btn btn-outline-primary w-100 mb-2">

                                    <i class="bi bi-eye"></i>
                                    View Details

                                </a>

                                <a
                                    href="product.php?id=<?= $row['id'] ?>"
                                    class="btn btn-success w-100">

                                    <i class="bi bi-cart-fill"></i>
                                    Add to Cart

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

        <?php

            }

        } else {

            echo "<div class='alert alert-warning'>
                    <i class='bi bi-exclamation-circle'></i>
                    No products found.
                  </div>";
        }

        ?>

    </div>

</div>

<?php
include 'includes/footer.php';
?>