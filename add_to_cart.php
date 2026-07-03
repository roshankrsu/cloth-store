<?php
session_start();
include 'config/database.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
    header("Location: products.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = (int)$_POST['product_id'];
$quantity = max(1, (int)$_POST['quantity']);

// Check if product already exists in cart
$check = mysqli_prepare($conn, "SELECT id, quantity FROM cart WHERE user_id=? AND product_id=?");
mysqli_stmt_bind_param($check, "ii", $user_id, $product_id);
mysqli_stmt_execute($check);

$result = mysqli_stmt_get_result($check);

if ($row = mysqli_fetch_assoc($result)) {

    $newQty = $row['quantity'] + $quantity;

    $update = mysqli_prepare($conn, "UPDATE cart SET quantity=? WHERE id=?");
    mysqli_stmt_bind_param($update, "ii", $newQty, $row['id']);
    mysqli_stmt_execute($update);

} else {

    $insert = mysqli_prepare($conn, "INSERT INTO cart(user_id, product_id, quantity) VALUES(?,?,?)");
    mysqli_stmt_bind_param($insert, "iii", $user_id, $product_id, $quantity);
    mysqli_stmt_execute($insert);

}

header("Location: cart.php");
exit;