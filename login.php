<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT user_id, password, role, linked_patient_id, linked_doctor_id, linked_nurse_id
                            FROM UserAccount WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password, $role, $linked_patient_id, $linked_doctor_id, $linked_nurse_id);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["role"] = $role;
            $_SESSION["linked_patient_id"] = $linked_patient_id;
            $_SESSION["linked_doctor_id"] = $linked_doctor_id;
            $_SESSION["linked_nurse_id"] = $linked_nurse_id;

            if ($role === "doctor") {
                header("Location: doctor/dashboard.php");
            } elseif ($role === "nurse") {
                header("Location: nurse/dashboard.php");
            } elseif ($role === "patient") {
                header("Location: patient/dashboard.php");
            } elseif ($role === "admin") {
                header("Location: admin/dashboard.php");
            } else {
                echo "Unknown role.";
            }
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <link rel="stylesheet" href="css/form_views.css" />
</head>
<body>
  <h2>Login</h2>
  <form action="login.php" method="POST">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
  </form>
  <p>Don’t have an account? <a href="register.html">Register here</a></p>
</body>
</html>
