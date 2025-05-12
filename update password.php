<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['new-password'] ?? '';
    $confirm = $_POST['confirm-password'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($password) || strlen($password) < 8) {
        $error = "Das Passwort muss mindestens 8 Zeichen lang sein.";
    } elseif ($password !== $confirm) {
        $error = "Die Passwörter stimmen nicht überein.";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Ungültige E-Mail-Adresse.";
    } else {
        // Passwort speichern (z. B. in Datenbank) – hier nur simuliert
        // password_hash() verwenden:
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Beispielausgabe – in Realität würdest du jetzt in die Datenbank schreiben
        $success = "Passwort erfolgreich zurückgesetzt.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Passwort zurücksetzen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f9fd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 400px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Passwort zurücksetzen</h1>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php elseif (!empty($success)): ?>
        <div class="success"><?= $success ?></div>
    <?php else: ?>
        <div class="error">Ein Fehler ist aufgetreten.</div>
    <?php endif; ?>
</div>

</body>
</html>
