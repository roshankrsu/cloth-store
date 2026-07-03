<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            🛍️ Cloth Store
        </a>

        <button class="navbar-toggler"
            data-bs-toggle="collapse"
            data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="offers.php">Offers</a>
                </li>

                <?php if(isset($_SESSION['user'])) { ?>

<li class="nav-item">
    <span class="nav-link">
        👋 <?= htmlspecialchars($_SESSION['user']['full_name']) ?>
    </span>
</li>

<li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
</li>

<?php } else { ?>

<li class="nav-item">
    <a class="nav-link" href="login.php">Login</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="register.php">Register</a>
</li>

<?php } ?>

            </ul>

        </div>

    </div>

</nav>