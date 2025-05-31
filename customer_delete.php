<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);

    $sql = "DELETE FROM customer WHERE customer_id='$customer_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: customer.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: customer.php");
    exit();
}
?>
