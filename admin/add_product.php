<?php
include '../config/database.php';
include '../includes/header.php';
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">
<h3>Add Product</h3>
</div>

<div class="card-body">

<?php if (isset($_GET['success'])) { ?>

<div class="alert alert-success">
    Product added successfully!
</div>

<?php } ?>

<form action="save_product.php" method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Product Name</label>
<input type="text" name="product_name" class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control" rows="4"></textarea>
</div>

<div class="mb-3">
<label>Price</label>
<input type="number" step="0.01" name="price" class="form-control" required>
</div>

<div class="mb-3">
<label>Stock</label>
<input type="number" name="stock" class="form-control" required>
</div>

<div class="mb-3">
<label>Category</label>

<select name="category_id" class="form-select">

<?php

$result = mysqli_query($conn,"SELECT * FROM categories");

while($row=mysqli_fetch_assoc($result))
{

?>

<option value="<?= $row['id'] ?>">
<?= htmlspecialchars($row['category_name']) ?>
</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">
<label>Product Image</label>
<input type="file" name="image" class="form-control" required>
</div>

<button class="btn btn-success">
Add Product
</button>

</form>

</div>

</div>

</div>

<?php
include '../includes/footer.php';
?>