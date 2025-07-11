<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "patient") {
  header("Location: ../login.html");
  exit;
}
include("../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $conn->prepare("INSERT INTO Appointments (patient_name, patient_id, email_address, phone_number, date_of_birth, preferred_date, preferred_time, department, reason_for_appointment, additional_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param(
    "ssssssssss",
    $_POST["patient_name"],
    $_SESSION["linked_patient_id"],
    $_POST["email_address"],
    $_POST["phone_number"],
    $_POST["date_of_birth"],
    $_POST["preferred_date"],
    $_POST["preferred_time"],
    $_POST["department"],
    $_POST["reason_for_appointment"],
    $_POST["additional_notes"]
  );
  $stmt->execute();
  echo "Appointment booked.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Book Appointment</title>
  <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>
  <h2>Book Appointment</h2>
  <form method="POST">
    <label>Patient Name: <input name="patient_name" required></label><br>
    <label>Email: <input type="email" name="email_address" required></label><br>
    <label>Phone Number: <input name="phone_number" required></label><br>
    <label>Date of Birth: <input type="date" name="date_of_birth" required></label><br>
    <label>Preferred Date: <input type="date" name="preferred_date" required></label><br>
    <label>Preferred Time: <input type="time" name="preferred_time" required></label><br>
    <label>Department:
      <select name="department">
        <option value="General">General</option>
        <option value="Pediatrics">Pediatrics</option>
        <option value="Cardiology">Cardiology</option>
        <option value="Dermatology">Dermatology</option>
        <option value="Orthopedics">Orthopedics</option>
        <option value="Gynaecology">Gynaecology</option>
        <option value="Psychiatry">Psychiatry</option>
      </select>
    </label><br>
    <label>Reason: <input name="reason_for_appointment"></label><br>
    <label>Additional Notes: <textarea name="additional_notes"></textarea></label><br>
    <button type="submit">Book</button>
  </form>
</body>
</html>
