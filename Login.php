<?php
$email = '';
$error = '';
$showUpdateForm = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
    } else {
        // Hier würdest du prüfen, ob die E-Mail in der Datenbank existiert und ggf. einen Token versenden
        $showUpdateForm = true;
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Passwort vergessen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f9fd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #4bb1e0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label, input, button {
            display: block;
            width: 100%;
            font-size: 14px;
        }
        input, button {
            padding: 10px;
            margin-top: 5px;
        }
        input {
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input:focus {
            border-color: #4bb1e0;
        }
        button {
            background-color: #4bb1e0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #3a9ac5;
        }
        .error {
            color: red;
            font-size: 12px;
        }
        .success {
            color: green;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Passwort vergessen</h1>

    <?php if (!$showUpdateForm): ?>
        <form action="reset_password.php" method="post">
            <div class="form-group">
                <label for="email">E-Mail-Adresse</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                <?php if (!empty($error)): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button type="submit">E-Mail senden</button>
            </div>
        </form>
    <?php else: ?>
        <div class="success">Eine E-Mail wurde gesendet. Bitte setzen Sie Ihr Passwort hier zurück:</div>
        <form action="update_password.php" method="post">
            <div class="form-group">
                <label for="new-password">Neues Passwort</label>
                <input type="password" id="new-password" name="new-password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Neues Passwort bestätigen</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>

            <div class="form-group">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <button type="submit">Passwort zurücksetzen</button>
            </div>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
