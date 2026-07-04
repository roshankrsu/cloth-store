<?php
include 'config/auth.php';
include 'config/database.php';
include 'includes/header.php';
include 'includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: my_orders.php");
    exit;
}

$order_id = (int)$_GET['id'];
$user_id = $_SESSION['user']['id'];

// Verify the order belongs to the logged-in user
$orderStmt = mysqli_prepare($conn, "SELECT * FROM orders WHERE id=? AND user_id=?");
mysqli_stmt_bind_param($orderStmt, "ii", $order_id, $user_id);
mysqli_stmt_execute($orderStmt);
$orderResult = mysqli_stmt_get_result($orderStmt);

if (mysqli_num_rows($orderResult) == 0) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Order not found.</div></div>";
    include 'includes/footer.php';
    exit;
}

$order = mysqli_fetch_assoc($orderResult);

// Get order items
$sql = "SELECT
            oi.quantity,
            oi.price,
            p.product_name,
            p.image
        FROM order_items oi
        INNER JOIN products p
        ON oi.product_id = p.id
        WHERE oi.order_id=?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $order_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<div class="container mt-5">

<h2 class="mb-4">
    Order #<?= $order_id ?>
</h2>

<div class="card shadow">

<div class="card-body">

<table class="table table-bordered">

<thead class="table-dark">

<tr>
<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
</tr>

</thead>

<tbody>

<?php
$grandTotal = 0;

while($row = mysqli_fetch_assoc($result)){

$itemTotal = $row['price'] * $row['quantity'];
$grandTotal += $itemTotal;
?>

<tr>

<td width="120">
<img
src="assets/images/products/<?= htmlspecialchars($row['image']) ?>"
class="img-fluid rounded">
</td>

<td><?= htmlspecialchars($row['product_name']) ?></td>

<td>₹<?= number_format($row['price'],2) ?></td>

<td><?= $row['quantity'] ?></td>

<td>₹<?= number_format($itemTotal,2) ?></td>

</tr>

<?php } ?>

</tbody>

</table>

<div class="text-end">

<h3>
Grand Total:
₹<?= number_format($grandTotal,2) ?>
</h3>

<h5>
Status:
<span class="badge bg-warning">
<?= htmlspecialchars($order['status']) ?>
</span>
</h5>

</div>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>