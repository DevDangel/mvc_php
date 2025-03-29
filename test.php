<?php
$password = "angel";
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

echo "Original Password: " . $password . "\n";
echo "Hashed Password: " . $hashedPassword . "\n";

// Verificación
if (password_verify($password, $hashedPassword)) {
    echo "Password Verified\n";
} else {
    echo "Password Not Verified\n";
}
?>
