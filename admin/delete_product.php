<?php

include '../config/auth.php';
include '../config/database.php';

if (!isset($_GET['id'])) {
    header("Location: manage_products.php");
    exit;
}

$id = (int)$_GET['id'];

// Get image name
$stmt = mysqli_prepare($conn, "SELECT image FROM products WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($product = mysqli_fetch_assoc($result)) {

    $imagePath = "../assets/images/products/" . $product['image'];

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $delete = mysqli_prepare($conn, "DELETE FROM products WHERE id=?");
    mysqli_stmt_bind_param($delete, "i", $id);
    mysqli_stmt_execute($delete);
}

header("Location: manage_products.php");
exit;
