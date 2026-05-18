<?php
// Temporary: enable error display to surface issues (remove on production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session (header include will also start if included later)
session_start();

$conn = mysqli_connect('localhost', 'root', '', '2028_sante');
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $msg = "<p style='color:green; text-align:center;'>Bienvenue " . htmlspecialchars($user['full_name']) . " !</p>";
        // Redirect to reservation page after login
        header('Location: /APP2028/2028_Sante/frontend/pages/reservation/reservation.php');
        exit();
    } else {
        $msg = "<p style='color:red; text-align:center;'>Identifiants invalides.</p>";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/assets/styles/main.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/layouts/header/header.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/layouts/footer/footer.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/auth/login.css">
</head>
<body>
    <?php include __DIR__ . '/../layouts/header/header.php'; ?>

    <main class="login-page">
        <section class="login-container">
            <h1>Connexion</h1>
            <?= $msg; ?>
            <form method="POST" class="auth-form">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" name="email" id="login-email" required placeholder="vous@gmail.com">
                </div>
                <div class="form-group">
                    <label for="login-password">Mot de passe</label>
                    <input type="password" name="password" id="login-password" required placeholder="••••••••">
                </div>
                <button type="submit" name="login_btn" class="btn btn-primary btn-full">Se connecter</button>
            </form>
            <p class="mt-10 text-center">Pas de compte ? <a href="/APP2028/2028_Sante/authentification/register.php">Inscrivez-vous</a></p>
        </section>
    </main>

    <?php include __DIR__ . '/../layouts/footer/footer.php'; ?>
</body>
</html>
