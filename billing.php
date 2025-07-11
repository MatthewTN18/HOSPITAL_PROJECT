<?php
session_start();
include("../db.php");

// Example: Only allow if logged in and role is allowed (doctor, admin, billing officer, etc.)
if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] != "doctor" && $_SESSION["role"] != "admin")) {
    header("Location: ../login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = trim($_POST["patient_id"]);
    $patient_name = trim($_POST["patient_name"]);
    $billing_date = $_POST["billing_date"];
    $services_offered = trim($_POST["services_offered"]);
    $service_cost = floatval($_POST["service_cost"]);
    $services_subtotal = floatval($_POST["services_subtotal"]);
    $prescribed_drugs = trim($_POST["prescribed_drugs"]);
    $drugs_total_cost = floatval($_POST["drugs_total_cost"]);
    $insurance_provider = trim($_POST["insurance_provider"]);
    $insurance_coverage = $_POST["insurance_coverage"];
    $insurance_percentage = floatval($_POST["insurance_percentage"]);
    $total_charge = floatval($_POST["total_charge"]);
    $amount_paid = floatval($_POST["amount_paid"]);
    $balance_due = floatval($_POST["balance_due"]);
    $payment_status = $_POST["payment_status"];

    $stmt = $conn->prepare("INSERT INTO Billing 
    (patient_id, patient_name, billing_date, services_offered, service_cost, services_subtotal, prescribed_drugs, drugs_total_cost, insurance_provider, insurance_coverage, insurance_percentage, total_charge, amount_paid, balance_due, payment_status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssddssdssddds",
        $patient_id,
        $patient_name,
        $billing_date,
        $services_offered,
        $service_cost,
        $services_subtotal,
        $prescribed_drugs,
        $drugs_total_cost,
        $insurance_provider,
        $insurance_coverage,
        $insurance_percentage,
        $total_charge,
        $amount_paid,
        $balance_due,
        $payment_status
    );

    if ($stmt->execute()) {
        echo "<p>Billing record added successfully.</p>";
    } else {
        echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Billing Record</title>
    <link rel="stylesheet" href="../css/form_views.css" />
</head>
<body>
    <h2>Add Billing Record</h2>

    <form method="POST" action="billing.php">
        <label>Patient ID: <input type="text" name="patient_id" required></label><br>
        <label>Patient Name: <input type="text" name="patient_name" required></label><br>
        <label>Billing Date: <input type="date" name="billing_date" required></label><br>
        <label>Services Offered: <input type="text" name="services_offered" required></label><br>
        <label>Service Cost: <input type="number" name="service_cost" step="0.01" required></label><br>
        <label>Services Subtotal: <input type="number" name="services_subtotal" step="0.01" required></label><br>
        <label>Prescribed Drugs: <input type="text" name="prescribed_drugs"></label><br>
        <label>Drugs Total Cost: <input type="number" name="drugs_total_cost" step="0.01"></label><br>
        <label>Insurance Provider: <input type="text" name="insurance_provider"></label><br>
        <label>Insurance Coverage:
            <select name="insurance_coverage" required>
                <option value="full">Full</option>
                <option value="partial">Partial</option>
            </select>
        </label><br>
        <label>Insurance Percentage: <input type="number" name="insurance_percentage" step="0.01"></label><br>
        <label>Total Charge: <input type="number" name="total_charge" step="0.01" required></label><br>
        <label>Amount Paid: <input type="number" name="amount_paid" step="0.01" required></label><br>
        <label>Balance Due: <input type="number" name="balance_due" step="0.01" required></label><br>
        <label>Payment Status:
            <select name="payment_status" required>
                <option value="paid">Paid</option>
                <option value="partially_paid">Partially Paid</option>
                <option value="unpaid">Unpaid</option>
            </select>
        </label><br>

        <button type="submit">Add Billing Record</button>
    </form>

    <p><a href="../doctor/dashboard.php">Back to Dashboard</a></p>
</body>
</html>
