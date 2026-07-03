<?php
include 'config/database.php';
include 'includes/header.php';
include 'includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit;
}

$id = (int)$_GET['id'];

$sql = "SELECT p.*, c.category_name
        FROM products p
        LEFT JOIN categories c
        ON p.category_id = c.id
        WHERE p.id=?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Product not found.</div></div>";
    include 'includes/footer.php';
    exit;
}

$product = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">

<div class="row">

<div class="col-md-6">

<img
src="assets/images/products/<?= htmlspecialchars($product['image']) ?>"
class="img-fluid rounded shadow"
alt="<?= htmlspecialchars($product['product_name']) ?>">

</div>

<div class="col-md-6">

<h2><?= htmlspecialchars($product['product_name']) ?></h2>

<p class="text-muted">
Category:
<strong><?= htmlspecialchars($product['category_name']) ?></strong>
</p>

<h3 class="text-success">
₹<?= number_format($product['price'],2) ?>
</h3>

<p>
<?= nl2br(htmlspecialchars($product['description'])) ?>
</p>

<p>
<strong>Stock:</strong>
<?= (int)$product['stock'] ?>
</p>

<form action="add_to_cart.php" method="POST">

    <input
        type="hidden"
        name="product_id"
        value="<?= $product['id'] ?>">

    <div class="mb-3">

        <label class="form-label">Quantity</label>

        <input
            type="number"
            name="quantity"
            class="form-control"
            value="1"
            min="1"
            max="<?= (int)$product['stock'] ?>"
            required>

    </div>

    <button
        type="submit"
        class="btn btn-success btn-lg">
        🛒 Add to Cart
    </button>

</form>

<button class="btn btn-success btn-lg">
🛒 Add to Cart
</button>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>