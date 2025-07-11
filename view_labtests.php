<?php
session_start();
include("../db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "doctor") {
    header("Location: ../login.html");
    exit;
}

$result = $conn->query("SELECT * FROM LabTest");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lab Tests</title>
      <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>

<h2>View Lab Tests</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Patient Name</th>
        <th>Type of Test</th>
        <th>Doctor's Instruction</th>
        <th>Date Requested</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['labtest_id'] ?></td>
        <td><?= $row['patient_name'] ?></td>
        <td><?= $row['type_of_test'] ?></td>
        <td><?= $row['doctors_instruction'] ?></td>
        <td><?= $row['date_requested'] ?></td>
    </tr>
    <?php } ?>
</table>

<a href="dashboard.php">Back to Dashboard</a>

    
</body>
</html>
