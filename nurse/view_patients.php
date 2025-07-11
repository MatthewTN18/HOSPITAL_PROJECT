<?php
session_start();
include("../db.php");
$result = $conn->query("SELECT * FROM PatientInformation");
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
    <h2>All Patients</h2>
<table border="1">
<tr><th>ID</th><th>Name</th><th>DOB</th><th>Gender</th></tr>
<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
  <td><?= $row["patient_id"] ?></td>
  <td><?= $row["patient_name"] ?></td>
  <td><?= $row["date_of_birth"] ?></td>
  <td><?= $row["gender"] ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>