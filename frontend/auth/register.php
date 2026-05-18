<?php
// Simple registration page (minimal validation). Replace or secure for production.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) session_start();

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_btn'])) {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($fullname === '' || $email === '' || $password === '') {
        $msg = '<p style="color:red; text-align:center;">Veuillez remplir tous les champs.</p>';
    } else {
        $conn = mysqli_connect('localhost', 'root', '', '2028_sante');
        if (!$conn) { $msg = '<p style="color:red; text-align:center;">Erreur de connexion BDD.</p>'; }
        else {
            mysqli_set_charset($conn, 'utf8mb4');
            // Check if email exists
            $sql = 'SELECT id FROM users WHERE email = ?';
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                $msg = '<p style="color:red; text-align:center;">Cet email est déjà enregistré.</p>';
                mysqli_stmt_close($stmt);
            } else {
                mysqli_stmt_close($stmt);
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $insert = 'INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)';
                $stmt2 = mysqli_prepare($conn, $insert);
                mysqli_stmt_bind_param($stmt2, 'sss', $fullname, $email, $hash);
                if (mysqli_stmt_execute($stmt2)) {
                    $msg = '<p style="color:green; text-align:center;">Inscription réussie — vous pouvez maintenant vous connecter.</p>';
                } else {
                    $msg = '<p style="color:red; text-align:center;">Erreur lors de l\'inscription.</p>';
                }
                mysqli_stmt_close($stmt2);
            }
            mysqli_close($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/assets/styles/main.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/layouts/header/header.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/auth/register.css">
</head>
<body>
    <?php include __DIR__ . '/../layouts/header/header.php'; ?>
    <main class="login-page">
        <section class="login-container">
            <h1>Inscription</h1>
            <?= $msg; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Nom complet</label>
                    <input type="text" name="fullname" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" required>
                </div>
                <button name="register_btn" class="btn btn-primary btn-full" type="submit">S'inscrire</button>
            </form>
            <p class="mt-10 text-center">Déjà inscrit ? <a href="/APP2028/2028_Sante/frontend/auth/login.php">Se connecter</a></p>
        </section>
    </main>
    <?php include __DIR__ . '/../layouts/footer/footer.php'; ?>
</body>
</html>
