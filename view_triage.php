<?php
session_start();
include("../db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "doctor") {
    header("Location: ../login.html");
    exit;
}

$result = $conn->query("SELECT * FROM TriageForm");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Triage Records</title>
    <link rel="stylesheet" href="../css/form_views.css">
</head>
<body>
    <h2>View Triage Records</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Patient Name</th>
        <th>Age</th>
        <th>Weight</th>
        <th>Height</th>
        <th>Temperature</th>
        <th>Blood Pressure</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['triage_id'] ?></td>
        <td><?= $row['patient_name'] ?></td>
        <td><?= $row['age'] ?></td>
        <td><?= $row['weight'] ?></td>
        <td><?= $row['height'] ?></td>
        <td><?= $row['temperature'] ?></td>
        <td><?= $row['blood_pressure'] ?></td>
    </tr>
    <?php } ?>
</table>

<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
