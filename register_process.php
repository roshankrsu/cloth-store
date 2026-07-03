<?php

include 'config/database.php';

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users
(full_name,email,phone,username,password)
VALUES (?,?,?,?,?)";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param(
$stmt,
"sssss",
$full_name,
$email,
$phone,
$username,
$password
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: login.php");
    exit;
} else {
    if (mysqli_errno($conn) == 1062) {
        echo "<script>
            alert('Email or Username already exists!');
            window.location='register.php';
        </script>";
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}