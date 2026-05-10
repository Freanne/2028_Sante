<?php
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$message = 'Utilisez le formulaire de réinitialisation.';

if ($method === 'POST') {
	$email = trim($_POST['email'] ?? '');
	if ($email === '') {
		$message = 'Email requis.';
	} else {
		$message = 'Demande de réinitialisation reçue (base minimale).';
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Réinitialisation - Backend</title>
</head>
<body>
	<p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
	<p><a href="../../frontend/pages/reset_password/reset_password.html">Retour</a></p>
</body>
</html>
