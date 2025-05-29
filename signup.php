<?php
// 1. Sambung ke MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahk_company";

$conn = new mysqli($servername, $username, $password, $dbname);

// 2. Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3. Semak jika form dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 4. Ambil nilai POST
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // 5. validation nilai kosong
    if ($name && $email && $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 6. SQL Insert (guna prepared statement untuk keselamatan)
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Sign up successfully! You can login now.";
        } else {
            echo "SQL error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all fields completely.";
    }
}

$conn->close();
?>
