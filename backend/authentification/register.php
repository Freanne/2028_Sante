<?php
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$message = 'Utilisez le formulaire d\'inscription.';

if ($method === 'POST') {
	$name = trim($_POST['nom'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$password = trim($_POST['password'] ?? '');
	$confirm = trim($_POST['password_confirm'] ?? '');
	if ($name === '' || $email === '' || $password === '' || $confirm === '') {
		$message = 'Tous les champs sont requis.';
	} elseif ($password !== $confirm) {
		$message = 'Les mots de passe ne correspondent pas.';
	} else {
		$message = 'Inscription reçue (base minimale).';
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inscription - Backend</title>
</head>
<body>
	<p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
	<p><a href="../../frontend/pages/register/register.html">Retour</a></p>
</body>
</html>
