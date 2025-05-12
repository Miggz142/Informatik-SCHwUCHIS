<?php
// Initialisiere Variablen
$errors = [];
$values = [
    'username' => '',
    'email' => '',
    'first-name' => '',
    'last-name' => '',
    'dob' => ''
];

// Wenn das Formular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Eingaben speichern
    foreach ($values as $key => $_) {
        $values[$key] = htmlspecialchars(trim($_POST[$key] ?? ''));
    }

    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    // Validierung
    if (empty($values['username'])) {
        $errors['username'] = "Bitte geben Sie einen Benutzernamen ein.";
    }

    if (empty($values['email']) || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
    }

    if (empty($password)) {
        $errors['password'] = "Bitte geben Sie ein Passwort ein.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Das Passwort muss mindestens 8 Zeichen lang sein.";
    }

    if ($confirmPassword !== $password) {
        $errors['confirm-password'] = "Die Passwörter stimmen nicht überein.";
    }

    if (empty($values['first-name'])) {
        $errors['first-name'] = "Bitte geben Sie Ihren Vornamen ein.";
    }

    if (empty($values['last-name'])) {
        $errors['last-name'] = "Bitte geben Sie Ihren Nachnamen ein.";
    }

    if (empty($values['dob'])) {
        $errors['dob'] = "Bitte geben Sie Ihr Geburtsdatum ein.";
    } else {
        $dob = new DateTime($values['dob']);
        $today = new DateTime();
        $age = $today->diff($dob)->y;
        if ($age < 18) {
            $errors['dob'] = "Sie müssen mindestens 18 Jahre alt sein.";
        }
    }

    // Wenn keine Fehler: Erfolgsmeldung oder Weiterleitung
    if (empty($errors)) {
        echo "<p style='text-align:center; color: green;'>Registrierung erfolgreich!</p>";
        // Hier könntest du die Daten z.B. in eine Datenbank speichern
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierungsseite</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #1e3a8a;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }
        .form-group input:focus {
            border-color: #1e3a8a;
            outline: none;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #1e3a8a;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #1c2a60;
        }
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Registrierung</h1>
    <form method="post" action="">

        <div class="form-group">
            <label for="username">Benutzername</label>
            <input type="text" id="username" name="username" value="<?= $values['username'] ?>">
            <?php if (isset($errors['username'])): ?>
                <div class="error"><?= $errors['username'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">E-Mail-Adresse</label>
            <input type="email" id="email" name="email" value="<?= $values['email'] ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Passwort</label>
            <input type="password" id="password" name="password">
            <?php if (isset($errors['password'])): ?>
                <div class="error"><?= $errors['password'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="confirm-password">Passwort bestätigen</label>
            <input type="password" id="confirm-password" name="confirm-password">
            <?php if (isset($errors['confirm-password'])): ?>
                <div class="error"><?= $errors['confirm-password'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="first-name">Vorname</label>
            <input type="text" id="first-name" name="first-name" value="<?= $values['first-name'] ?>">
            <?php if (isset($errors['first-name'])): ?>
                <div class="error"><?= $errors['first-name'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="last-name">Nachname</label>
            <input type="text" id="last-name" name="last-name" value="<?= $values['last-name'] ?>">
            <?php if (isset($errors['last-name'])): ?>
                <div class="error"><?= $errors['last-name'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="dob">Geburtsdatum</label>
            <input type="date" id="dob" name="dob" value="<?= $values['dob'] ?>">
            <?php if (isset($errors['dob'])): ?>
                <div class="error"><?= $errors['dob'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <button type="submit">Registrieren</button>
        </div>
    </form>
</div>

</body>
</html>
