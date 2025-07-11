<?php
session_start();
include("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $patient_name = $_POST["patient_name"];
  $age = $_POST["age"];
  $weight = $_POST["weight"];
  $height = $_POST["height"];
  $temperature = $_POST["temperature"];
  $blood_pressure = $_POST["blood_pressure"];

  $stmt = $conn->prepare("INSERT INTO TriageForm (patient_name, age, weight, height, temperature, blood_pressure) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("siddds", $patient_name, $age, $weight, $height, $temperature, $blood_pressure);
  $stmt->execute();
  echo "<p>Triage form submitted successfully.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Triage Form</title>
  <link rel="stylesheet" href="../css/form_views.css">
</head>
<body>
  <h2>Triage Form</h2>
  <form method="POST">
    <label>Patient Name: <input name="patient_name" required></label><br>
    <label>Age: <input type="number" name="age" required></label><br>
    <label>Weight (kg): <input type="number" step="0.1" name="weight" required></label><br>
    <label>Height (cm): <input type="number" step="0.1" name="height" required></label><br>
    <label>Temperature (°C): <input type="number" step="0.1" name="temperature" required></label><br>
    <label>Blood Pressure: <input name="blood_pressure" required></label><br>
    <button type="submit">Submit Triage</button>
  </form>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
