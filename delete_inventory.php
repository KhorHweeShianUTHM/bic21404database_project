<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['inventory_id'])) {
        $inventoryId = intval($_POST['inventory_id']);

        include 'config.php'; // database connection

        // Delete query
        $sql = "DELETE FROM inventory WHERE inventory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $inventoryId);

        if ($stmt->execute()) {
            // Success — redirect back
            header("Location: inventory.php?deleted=1");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Inventory ID missing.";
    }
 else {
    echo "Invalid request.";
}
?>
