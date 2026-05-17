<?php
// $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
// $message = 'Utilisez le formulaire de connexion.';

// if ($method === 'POST') {
// 	$email = trim($_POST['email'] ?? '');
// 	$password = trim($_POST['password'] ?? '');
// 	if ($email === '' || $password === '') {
// 		$message = 'Email et mot de passe requis.';
// 	} else {
// 		$message = 'Connexion reçue (base minimale).';
// 	}
// }


?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Connexion - Backend</title>
</head>
<body>
	<p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
	<p><a href="../../frontend/pages/login/login.html">Retour</a></p>
</body>
</html> 
