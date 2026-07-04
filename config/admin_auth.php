<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['user']['role'] !== 'admin') {
    echo "<div style='text-align:center;margin-top:100px;'>
            <h2 style='color:red;'>Access Denied!</h2>
            <p>You are not authorized to access this page.</p>
            <a href='../index.php'>Go Back</a>
          </div>";
    exit;
}
?>