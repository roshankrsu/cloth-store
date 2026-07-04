<?php
include 'config/database.php';
include 'includes/header.php';
include 'includes/navbar.php';

$limit = 6;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
?>

<div class="container mt-5">

    <h2 class="mb-4">
        <i class="bi bi-bag-fill"></i> Our Products
    </h2>

    <!-- Search & Category Filter -->
    <form method="GET" class="mb-4">

        <div class="row">

            <div class="col-md-5">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search products..."
                    value="<?= htmlspecialchars($search) ?>">

            </div>

            <div class="col-md-4">

                <select
                    name="category"
                    class="form-select">

                    <option value="">All Categories</option>

                    <?php

                    $countSql = "SELECT COUNT(*) AS total
             FROM products
             WHERE 1=1";

                    $countParams = [];
                    $countTypes = "";

                    if (!empty($search)) {
                        $countSql .= " AND product_name LIKE ?";
                        $countParams[] = "%" . $search . "%";
                        $countTypes .= "s";
                    }

                    if (!empty($category)) {
                        $countSql .= " AND category_id=?";
                        $countParams[] = $category;
                        $countTypes .= "i";
                    }

                    $countStmt = mysqli_prepare($conn, $countSql);

                    if (!empty($countParams)) {
                        mysqli_stmt_bind_param($countStmt, $countTypes, ...$countParams);
                    }

                    mysqli_stmt_execute($countStmt);

                    $countResult = mysqli_stmt_get_result($countStmt);

                    $totalProducts = mysqli_fetch_assoc($countResult)['total'];

                    $totalPages = ceil($totalProducts / $limit);

                    $categories = mysqli_query(
                        $conn,
                        "SELECT * FROM categories ORDER BY category_name"
                    );

                    while ($cat = mysqli_fetch_assoc($categories)) {

                    ?>

                        <option
                            value="<?= $cat['id'] ?>"
                            <?= ($category == $cat['id']) ? 'selected' : '' ?>>

                            <?= htmlspecialchars($cat['category_name']) ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="col-md-3">

                <button class="btn btn-primary w-100">

                    <i class="bi bi-search"></i>
                    Search

                </button>

            </div>

        </div>

    </form>

    <div class="row">

        <?php

        $sql = "SELECT p.*, c.category_name
                FROM products p
                LEFT JOIN categories c
                ON p.category_id = c.id
                WHERE 1=1";

        $params = [];
        $types = "";

        if (!empty($search)) {

            $sql .= " AND p.product_name LIKE ?";

            $params[] = "%" . $search . "%";

            $types .= "s";
        }

        if (!empty($category)) {

            $sql .= " AND p.category_id=?";

            $params[] = $category;

            $types .= "i";
        }

        $sql .= " ORDER BY p.id DESC LIMIT ?, ?";

        $params[] = $offset;
        $params[] = $limit;

        $types .= "ii";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, $types, ...$params);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

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
                                <strong>Stock:</strong>
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

            ?>

            <div class="col-12">

                <div class="alert alert-warning text-center">

                    <i class="bi bi-exclamation-circle"></i>

                    No products found.

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<?php if ($totalPages > 1) { ?>

<nav class="mt-4">

<ul class="pagination justify-content-center">

<?php for ($i = 1; $i <= $totalPages; $i++) { ?>

<li class="page-item <?= ($i == $page) ? 'active' : '' ?>">

<a
class="page-link"
href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>">

<?= $i ?>

</a>

</li>

<?php } ?>

</ul>

</nav>

<?php } ?>

<?php
include 'includes/footer.php';
?>