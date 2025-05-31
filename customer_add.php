<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO customer (name, contact, vehicle, plate_number, service, last_visit) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $_POST['name'], $_POST['contact'], $_POST['vehicle'], $_POST['plate_number'], $_POST['service'], $_POST['last_visit']);
    
    if ($stmt->execute()) {
        header("Location: customer.php");
        exit();
    } else {
        // For debugging, you can echo $stmt->error here
        header("Location: customer.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
