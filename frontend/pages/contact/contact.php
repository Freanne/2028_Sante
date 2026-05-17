<!DOCTYPE php>
<php lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact | Projet Anti-Sédentarité</title>
	<link rel="stylesheet" href="../../assets/css/main.css">
	<link rel="stylesheet" href="../../layouts/header/header.css">
	<link rel="stylesheet" href="../../layouts/footer/footer.css">
	<link rel="stylesheet" href="contact.css">
</head>
<body>

	<?php include __DIR__ . '/../../layouts/header/header.php'; ?>

	<main>
		<section class="page-hero">
			<h1>Nous Contacter</h1>
			<p>Base de formulaire (aucun envoi).</p>
		</section>

		<section class="contact-container">
			<form class="contact-form" action="#" method="POST">
				<div class="form-group">
					<label for="nom">Nom complet</label>
					<input type="text" id="nom" name="nom" required>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" required>
				</div>
				<div class="form-group">
					<label for="message">Message</label>
					<textarea id="message" name="message" rows="4" required></textarea>
				</div>
				<button type="submit" class="btn-cta">Envoyer</button>
			</form>
		</section>
	</main>

	<?php include __DIR__ . '/../../layouts/footer/footer.php'; ?>

</body>
</php>
