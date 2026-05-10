<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accueil | Projet Anti-Sédentarité</title>
	<link rel="stylesheet" href="../../assets/css/main.css">
	<link rel="stylesheet" href="../../layouts/header/header.css">
	<link rel="stylesheet" href="../../layouts/footer/footer.css">
	<link rel="stylesheet" href="home.css">
</head>
<body>

	<?php include __DIR__ . '/../../layouts/header/header.html'; ?>

	<main>
		<section class="hero">
			<h1>CONNECTEZ-VOUS À VOTRE SANTÉ</h1>
			<p>Un objet connecté innovant développé par les étudiants de Polytech pour évaluer et améliorer vos habitudes de vie.</p>
		</section>

		<section id="projet" class="content-section">
			<h2>Notre Dispositif</h2>
			<p>Le dispositif est un objet connecté porté sur le corps (poignet, bras, ceinture, ou autre) capable de mesurer l’activité et l’inactivité tout au long de la journée.</p>
		</section>

		<section id="explications" class="grid-section">
			<div class="card blue-card">
				<h3>Le Contexte</h3>
				<p>La sédentarité est aujourd’hui un problème majeur de santé publique.</p>
			</div>
			<div class="card green-card">
				<h3>Le MET, c'est quoi ?</h3>
				<p>La magnitude (VM) des axes X, Y, Z est utilisée pour estimer les METs.</p>
			</div>
		</section>

		<section id="equipe" class="content-section text-center">
			<h2>L'Équipe</h2>
			<p>Étudiants en filière Système Embarqué, Automatisation et Capteurs (SEA).</p>
		</section>
	</main>

	<?php include __DIR__ . '/../../layouts/footer/footer.html'; ?>

</body>
</html>
