<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 shadow mx-auto" style="max-width:400px;">

<h4 class="text-center mb-3">Create Account</h4>

<form method="POST">
    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

    <button class="btn btn-primary w-100">Register</button>
</form>

</div>
</div>

</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users(name,email,password) 
              VALUES('$name','$email','$password')";

    if(mysqli_query($conn,$query)){
        echo "<script>alert('Registered Successfully'); window.location='login.php';</script>";
    } else {
        echo "Error: Email already exists";
    }
}
?>