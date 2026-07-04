<?php

include '../config/auth.php';
include '../config/database.php';

$id = (int)$_POST['id'];

$product_name = trim($_POST['product_name']);
$description = trim($_POST['description']);
$price = $_POST['price'];
$stock = $_POST['stock'];

$sql = "UPDATE products
SET product_name=?,
description=?,
price=?,
stock=?
WHERE id=?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssdii",
    $product_name,
    $description,
    $price,
    $stock,
    $id
);

if (mysqli_stmt_execute($stmt)) {

    header("Location: manage_products.php");
} else {

    echo mysqli_error($conn);
}
