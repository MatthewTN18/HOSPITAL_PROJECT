<?php
session_start();
include("../db.php");
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
    <h2>All Triage Forms</h2>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Age</th><th>Weight</th><th>Height</th><th>Temp</th><th>BP</th></tr>
<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
  <td><?= $row["triage_id"] ?></td>
  <td><?= $row["patient_name"] ?></td>
  <td><?= $row["age"] ?></td>
  <td><?= $row["weight"] ?></td>
  <td><?= $row["height"] ?></td>
  <td><?= $row["temperature"] ?></td>
  <td><?= $row["blood_pressure"] ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>
