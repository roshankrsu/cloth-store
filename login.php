<?php
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5" style="max-width:500px;">

<div class="card shadow">

<div class="card-header bg-dark text-white">
<h3>User Login</h3>
</div>

<div class="card-body">

<form action="login_process.php" method="POST">

<div class="mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Password</label>
<input
type="password"
name="password"
class="form-control"
required>
</div>

<button class="btn btn-primary w-100">
Login
</button>

</form>

</div>

</div>

</div>

<?php
include 'includes/footer.php';
?>