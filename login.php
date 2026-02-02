<?php 
include 'Includes/dbcon.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($username && $password) {

        // Single user table, password stored in plain text
        $query = "SELECT * FROM tblusers WHERE emailAddress = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Compare plain text passwords
        if ($user && $password === $user['password']) {
            $_SESSION['userId'] = $user['Id'];
            $_SESSION['firstName'] = $user['firstName'];
            header("Location: Musical_Academy/index.php");
            exit;
        } else {
            $error_message = "Invalid Email or Password!";
        }

    } else {
        $error_message = "Please fill in all required fields!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Musical Academy - Login</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-image: url('img/logo/loral1.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
}
.welcome-screen {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: black;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.text-center.mt-2 a {
    color: #28a745; 
    font-weight: 500;
}
.bokeh-container { position: absolute; width: 100%; height: 100%; }
.bokeh { position: absolute; border-radius: 50%; animation: bokeh-animation 5s infinite; }

.bokeh:nth-child(1) { width: 80px;  height: 80px;  background: rgba(255,105,180,0.3);  left: 10%;  top: 20%; }
.bokeh:nth-child(2) { width: 100px; height: 100px; background: rgba(75,0,130,0.3);    left: 80%;  top: 10%; }
.bokeh:nth-child(3) { width: 70px;  height: 70px;  background: rgba(255,165,0,0.3);    left: 90%;  top: 40%; }
.bokeh:nth-child(4) { width: 120px; height: 120px; background: rgba(0,255,127,0.3);   right: 75%; bottom: 30%; }
.bokeh:nth-child(5) { width: 90px;  height: 90px;  background: rgba(0,191,255,0.3);   left: 90%;  top: 70%; }
.bokeh:nth-child(6) { width: 60px;  height: 60px;  background: rgba(255,69,0,0.3);     left: 80%;  top: 60%; }
.bokeh:nth-child(7) { width: 110px; height: 110px; background: rgba(138,43,226,0.3);  right: 85%; bottom: 10%; }
.bokeh:nth-child(8) { width: 50px;  height: 50px;  background: rgba(60,179,113,0.3);   left: 70%;  top: 80%; }

@keyframes bokeh-animation{
0%{transform:translate(0,0);}
50%{transform:translate(20px,20px);}
100%{transform:translate(0,0);}
}

.position-relative { position: relative; }
</style>
</head>
<body>

<div id="welcomeScreen" class="welcome-screen">
    <img src="deer.png" style="width:30%">
</div>

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
<h3>Login</h3>
</center>

<?php if(isset($error_message)): ?>
<div class="alert alert-danger"><?= $error_message ?></div>
<?php endif; ?>

<form method="POST">
<div class="form-group">
<input type="email" name="username" class="form-control" placeholder="Email" required>
</div>

<div class="form-group position-relative">
<!-- Password field -->
<input type="password" name="password" id="loginPass" class="form-control" placeholder="Password" required>
<input type="checkbox" onclick="togglePass()"> Show Password
</div>

<input type="submit" class="btn btn-success btn-block" value="Login">

<div class="text-center mt-2">
  <a href="registration.php" class="btn btn-link">New user? Register here</a>
</div>
</form>

</div></div></div></div>

<script>
// ===== 0.5 SECOND DEER SCREEN =====
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function(){
        document.getElementById("welcomeScreen").style.display="none";
    }, 500);   // 0.5 seconds
});

// ===== SHOW / HIDE PASSWORD =====
function togglePass(){
    var pass = document.getElementById("loginPass");
    pass.type = (pass.type === "password") ? "text" : "password";
}
</script>

</body>
</html>
