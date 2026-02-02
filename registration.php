<?php 
include 'Includes/dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = $_POST['firstName'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $confirmPassword = $_POST['confirmPassword'] ?? null;

    if ($firstName && $email && $password && $confirmPassword) {

        if ($password !== $confirmPassword) {
            $error_message = "Passwords do not match!";
        } else {

            // Check if email already exists
            $stmt = $conn->prepare("SELECT * FROM tblusers WHERE emailAddress = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error_message = "Email already registered!";
            } else {
                $stmt = $conn->prepare("INSERT INTO tblusers (firstName, emailAddress, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $firstName, $email, $password); // plain text password
                if ($stmt->execute()) {
                    $success_message = "Registration successful! You can now login.";
                } else {
                    $error_message = "Registration failed. Try again!";
                }
            }
        }

    } else {
        $error_message = "Please fill all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Musical Academy - Registration</title>

<!-- Bootstrap CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background-image: url('img/logo/loral1.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
}

/* Welcome Screen */
.welcome-screen { 
    position: fixed; top:0; left:0; width:100%; height:100%; 
    background:black; display:flex; justify-content:center; align-items:center; z-index:9999; 
}

/* ================= Bokeh Animation ================= */
.bokeh-container {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.bokeh {
    position: absolute;
    border-radius: 50%;
    animation: bokeh-animation 6s infinite ease-in-out;
    opacity: 0.7;
}

/* Individual bokeh circles with unique size, color & position */
.bokeh:nth-child(1) { width: 80px;  height: 80px;  background: rgba(255,105,180,0.3);  left: 10%;  top: 20%; }
.bokeh:nth-child(2) { width: 100px; height: 100px; background: rgba(75,0,130,0.3);    left: 80%;  top: 10%; }
.bokeh:nth-child(3) { width: 70px;  height: 70px;  background: rgba(255,165,0,0.3);    left: 90%;  top: 40%; }
.bokeh:nth-child(4) { width: 120px; height: 120px; background: rgba(0,255,127,0.3);   right: 75%; bottom: 30%; }
.bokeh:nth-child(5) { width: 90px;  height: 90px;  background: rgba(0,191,255,0.3);   left: 90%;  top: 70%; }
.bokeh:nth-child(6) { width: 60px;  height: 60px;  background: rgba(255,69,0,0.3);     left: 80%;  top: 60%; }
.bokeh:nth-child(7) { width: 110px; height: 110px; background: rgba(138,43,226,0.3);  right: 85%; bottom: 10%; }
.bokeh:nth-child(8) { width: 50px;  height: 50px;  background: rgba(60,179,113,0.3);   left: 70%;  top: 80%; }

/* ================= Keyframes ================= */
@keyframes bokeh-animation {
    0%   { transform: scale(1) translateY(0); opacity: 0.5; }
    50%  { transform: scale(1.3) translateY(-25px); opacity: 0.9; }
    100% { transform: scale(1) translateY(0); opacity: 0.5; }
}
/* Link Styling */
.text-center.mt-2 a { color:#28a745; font-weight:500; }

/* Inputs always show password */
input[type="password"] { -webkit-text-security: none; /* Chrome/Safari */ }
</style>
</head>
<body>

<!-- Bokeh -->
<div class="bokeh-container">
<?php for($i=0;$i<8;$i++): ?>
<div class="bokeh"></div>
<?php endfor; ?>
</div>

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card p-4">

<center>
<img src="welcome.jpg" style="width:300px;height:150px">
<h3>Register</h3>
</center>

<?php if(isset($error_message)): ?>
<div class="alert alert-danger"><?= $error_message ?></div>
<?php endif; ?>

<?php if(isset($success_message)): ?>
<div class="alert alert-success"><?= $success_message ?></div>
<?php endif; ?>

<form method="POST">
<div class="form-group">
<input type="text" name="firstName" class="form-control" placeholder="Full Name" required>
</div>

<div class="form-group">
<input type="email" name="email" class="form-control" placeholder="Email" required>
</div>

<div class="form-group position-relative">
<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
</div>

<div class="form-group position-relative">
<input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password" required>
</div>

<div class="form-group">
<input type="checkbox" onclick="togglePassword()"> Show Password
</div>

<input type="submit" class="btn btn-primary btn-block" value="Register">

<div class="text-center mt-2">
<a href="login.php" class="btn btn-link">Already have an account? Login here</a>
</div>
</form>

</div></div></div></div>

<script>

// ===== SHOW / HIDE PASSWORD =====
function togglePassword(){
    var pass1 = document.getElementById("password");
    var pass2 = document.getElementById("confirmPassword");
    pass1.type = (pass1.type === "password") ? "text" : "password";
    pass2.type = (pass2.type === "password") ? "text" : "password";
}
</script>
</body>
</html>
