<?php
include 'config/auth.php';
include 'config/database.php';

$user_id = $_SESSION['user']['id'];

$shipping_name = trim($_POST['shipping_name']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);
$city = trim($_POST['city']);
$state = trim($_POST['state']);
$pincode = trim($_POST['pincode']);
$total = $_POST['total'];

mysqli_begin_transaction($conn);

try {

    // Insert into orders table
    $sql = "INSERT INTO orders
    (user_id, shipping_name, phone, address, city, state, pincode, total, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "issssssd",
        $user_id,
        $shipping_name,
        $phone,
        $address,
        $city,
        $state,
        $pincode,
        $total
    );

    mysqli_stmt_execute($stmt);

    $order_id = mysqli_insert_id($conn);

    // Get cart items
    $cartSql = "SELECT product_id, quantity
                FROM cart
                WHERE user_id=?";

    $cartStmt = mysqli_prepare($conn, $cartSql);
    mysqli_stmt_bind_param($cartStmt, "i", $user_id);
    mysqli_stmt_execute($cartStmt);

    $cartResult = mysqli_stmt_get_result($cartStmt);

    while ($item = mysqli_fetch_assoc($cartResult)) {

        // Get product price
        $priceStmt = mysqli_prepare(
            $conn,
            "SELECT price FROM products WHERE id=?"
        );

        mysqli_stmt_bind_param(
            $priceStmt,
            "i",
            $item['product_id']
        );

        mysqli_stmt_execute($priceStmt);

        $priceResult = mysqli_stmt_get_result($priceStmt);

        $product = mysqli_fetch_assoc($priceResult);

        $price = $product['price'];

        // Insert into order_items
        $insertItem = mysqli_prepare(
            $conn,
            "INSERT INTO order_items
            (order_id, product_id, quantity, price)
            VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $insertItem,
            "iiid",
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $price
        );

        mysqli_stmt_execute($insertItem);
    }

    // Clear cart
    $deleteCart = mysqli_prepare(
        $conn,
        "DELETE FROM cart WHERE user_id=?"
    );

    mysqli_stmt_bind_param(
        $deleteCart,
        "i",
        $user_id
    );

    mysqli_stmt_execute($deleteCart);

    mysqli_commit($conn);

    header("Location: order_success.php?id=" . $order_id);
    exit;

} catch (Exception $e) {

    mysqli_rollback($conn);

    die("Order Failed: " . $e->getMessage());
}