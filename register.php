<?php
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5" style="max-width:700px;">

<div class="card shadow">

<div class="card-header bg-primary text-white">
<h3>Create Account</h3>
</div>

<div class="card-body">

<form action="register_process.php" method="POST">

<div class="mb-3">
<label class="form-label">Full Name</label>
<input type="text" name="full_name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-success w-100">
Create Account
</button>

</form>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>