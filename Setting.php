<?php
$conn = new mysqli("localhost", "root", "", "ahk_payments");

// Add new user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];

        if ($action === "delete") {
            $id = $_POST["user_id"];
            $conn->query("DELETE FROM users WHERE user_id = $id");
        }

        if ($action === "edit") {
            $id = $_POST["user_id"];
            $fullName = $_POST["fullName"];
            $email = $_POST["email"];
            $role = $_POST["role"];
            $conn->query("UPDATE users SET full_name='$fullName', email='$email', role='$role' WHERE user_id=$id");
        }
    } else {
        // Add new user
        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $role = $_POST["role"];

        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullName, $email, $password, $role);
        $stmt->execute();
        $stmt->close();
    }
}

// Return updated user table
$result = $conn->query("SELECT user_id, full_name, email, role FROM users");
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . htmlspecialchars($row["full_name"]) . "</td>
        <td>" . htmlspecialchars($row["email"]) . "</td>
        <td>" . htmlspecialchars($row["role"]) . "</td>
        <td class='user-actions'>
            <button class='edit-btn' data-id='{$row["user_id"]}' data-name='{$row["full_name"]}' data-email='{$row["email"]}' data-role='{$row["role"]}'>Edit</button>
            <button class='delete-btn' data-id='{$row["user_id"]}'>Delete</button>
        </td>
    </tr>";
}

$conn->close();
?>
