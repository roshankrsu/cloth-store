<?php

include '../config/database.php';

$product_name = trim($_POST['product_name']);
$description  = trim($_POST['description']);
$price        = $_POST['price'];
$stock        = $_POST['stock'];
$category_id  = $_POST['category_id'];

$imageName = "";

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowed)) {
        die("Only JPG, JPEG, PNG and WEBP images are allowed.");
    }

    $imageName = time() . "_" . basename($_FILES['image']['name']);

    $target = "../assets/images/products/" . $imageName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        die("Image upload failed.");
    }
}

$sql = "INSERT INTO products
(category_id, product_name, description, price, stock, image)
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "issdis",
    $category_id,
    $product_name,
    $description,
    $price,
    $stock,
    $imageName
);

if (mysqli_stmt_execute($stmt)) {

    header("Location: add_product.php?success=1");
    exit;
} else {

    echo "Database Error: " . mysqli_error($conn);
}
