<?php
session_start();
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $patient_name = $_POST["patient_name"];
  $type_of_test = $_POST["type_of_test"];
  $doctors_instruction = $_POST["doctors_instruction"];

  $stmt = $conn->prepare("INSERT INTO LabTest (patient_name, type_of_test, doctors_instruction) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $patient_name, $type_of_test, $doctors_instruction);
  if ($stmt->execute()) {
    echo "Lab test requested successfully.";
  } else {
    echo "Error: " . $stmt->error;
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Request Lab Test</title>
  <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>
  <h2>Request Lab Test</h2>
  <form method="POST">
    <label>Patient Name: <input name="patient_name" required></label><br>
    <label>Type of Test: <input name="type_of_test" required></label><br>
    <label>Doctor's Instructions: <textarea name="doctors_instruction"></textarea></label><br>
    <button type="submit">Request Test</button>
  </form>
</body>
</html>
