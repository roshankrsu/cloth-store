<?php
include 'config/database.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<h2 class="mb-4">Our Products</h2>

<div class="row">

<?php

$sql = "SELECT p.*, c.category_name
        FROM products p
        LEFT JOIN categories c
        ON p.category_id = c.id
        ORDER BY p.id DESC";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

?>

<div class="col-md-4 mb-4">

<div class="card shadow h-100">

<img
src="assets/images/products/<?=
htmlspecialchars($row['image'])
?>"
class="card-img-top product-image"
alt="<?= htmlspecialchars($row['product_name']) ?>">

<div class="card-body">

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

<button class="btn btn-primary w-100">
Add to Cart
</button>

</div>

</div>

</div>

<?php

}

}else{

?>

<div class="alert alert-warning">
No products found.
</div>

<?php
}
?>

</div>

</div>

<?php
include 'includes/footer.php';
?> 