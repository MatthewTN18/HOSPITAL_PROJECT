<?php
session_start();
include("../db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "doctor") {
    header("Location: ../login.html");
    exit;
}

// Show all patients who have consultations with this doctor
$doctor_id = $_SESSION["linked_doctor_id"];

$sql = "SELECT DISTINCT p.patient_id, p.patient_name, p.date_of_birth, p.gender
        FROM PatientInformation p
        JOIN Consultation c ON p.patient_id = c.patient_id
        WHERE c.doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
    <link rel="stylesheet" href="../css/form_views.css">
</head>
<body>
    <h2>My Patients</h2>
<table border="1">
    <tr>
        <th>Patient ID</th>
        <th>Name</th>
        <th>DOB</th>
        <th>Gender</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= htmlspecialchars($row['patient_id']) ?></td>
        <td><?= htmlspecialchars($row['patient_name']) ?></td>
        <td><?= htmlspecialchars($row['date_of_birth']) ?></td>
        <td><?= htmlspecialchars($row['gender']) ?></td>
    </tr>
    <?php } ?>
</table>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>