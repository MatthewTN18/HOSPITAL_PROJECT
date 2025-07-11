<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "patient") {
  header("Location: ../login.html");
  exit;
}
include("../db.php");
$patient_id = $_SESSION["linked_patient_id"];
$result = $conn->query("SELECT * FROM Billing WHERE patient_id = '$patient_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Billing</title>
    <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>
  <h2>My Billing</h2>
  <table>
    <tr>
      <th>Date</th><th>Services</th><th>Subtotal</th><th>Drugs</th><th>Total</th><th>Paid</th><th>Balance</th><th>Status</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['billing_date'] ?></td>
      <td><?= $row['services_offered'] ?></td>
      <td><?= $row['services_subtotal'] ?></td>
      <td><?= $row['prescribed_drugs'] ?></td>
      <td><?= $row['total_charge'] ?></td>
      <td><?= $row['amount_paid'] ?></td>
      <td><?= $row['balance_due'] ?></td>
      <td><?= $row['payment_status'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
