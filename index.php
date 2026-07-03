<?php
include 'includes/header.php';
include 'includes/navbar.php';
include 'config/database.php';
?>

<!-- Hero Section -->
<section class="hero">

    <div class="container">

        <h1 class="display-4 fw-bold">
            Online Clothing Store
        </h1>

        <p class="lead">
            Modern Fashion For Everyone
        </p>

        <a href="products.php" class="btn btn-warning btn-lg">
            Shop Now
        </a>

    </div>

</section>

<!-- Latest Products -->
<div class="container mt-5">

    <h2 class="mb-4 text-center">
        Latest Products
    </h2>

    <div class="row">

        <?php

        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

        ?>

                <div class="col-md-4 mb-4">

                    <div class="card product-card shadow h-100">

                        <img
                            src="assets/images/products/<?=
                            htmlspecialchars($row['image'])
                            ?>"
                            class="card-img-top product-image"
                            alt="<?= htmlspecialchars($row['product_name']) ?>">

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">
                                <?= htmlspecialchars($row['product_name']) ?>
                            </h5>

                            <p class="card-text">
                                <?= htmlspecialchars($row['description']) ?>
                            </p>

                            <h4 class="text-success">
                                ₹<?= number_format($row['price'], 2) ?>
                            </h4>

                            <p class="text-muted">
                                Stock:
                                <?= (int)$row['stock'] ?>
                            </p>

                            <a
                                href="product.php?id=<?= $row['id'] ?>"
                                class="btn btn-primary mt-auto">
                                View Product
                            </a>

                        </div>

                    </div>

                </div>

        <?php

            }

        } else {

        ?>

            <div class="col-12">

                <div class="alert alert-warning text-center">

                    No products available.

                </div>

            </div>

        <?php
        }
        ?>

    </div>

</div>

<?php
include 'includes/footer.php';
?>