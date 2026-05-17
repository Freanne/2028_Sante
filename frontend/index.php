<!DOCTYPE php>
<php lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Projet Anti-Sédentarité | Polytech Annecy-Chambéry</title>
	<link rel="stylesheet" href="assets/styles/main.css">
	<link rel="stylesheet" href="layouts/header/header.css">
	<link rel="stylesheet" href="layouts/footer/footer.css">
	<link rel="stylesheet" href="pages/home/home.css">
</head>
<body>



<?php include __DIR__ . '/layouts/header/header.php'; ?>
	<main>
		<section class="hero">
			<h1>CONNECTEZ-VOUS À VOTRE SANTÉ</h1>
			<p>Un objet connecté innovant développé par les étudiants de Polytech pour évaluer et améliorer vos habitudes de vie.</p>
		</section>

		<section id="projet" class="content-section">
			<h2>Notre Dispositif</h2>
			<p>Le dispositif est un objet connecté porté sur le corps (poignet, bras, ceinture, ou autre) capable de mesurer l’activité et l’inactivité tout au long de la journée. Grâce à des capteurs (accéléromètre et gyroscope), il détectera les mouvements, les changements de position et les périodes de repos prolongées.</p>
		</section>

		<section id="explications" class="grid-section">
			<div class="card blue-card">
				<h3>Le Contexte</h3>
				<p>La sédentarité est aujourd’hui un problème majeur de santé publique. Le temps passé assis ou inactif augmente. Elle ne doit pas être confondue avec le manque d’activité physique : on peut être sportif régulier tout en restant sédentaire de nombreuses heures.</p>
			</div>

			<div class="card green-card">
				<h3>Le MET, c'est quoi ?</h3>
				<p>Par définition, 1 MET correspond à une consommation de 3,5 ml d'oxygène par kg et par minute. Notre algorithme utilise la régression linéaire sur la magnitude (VM) des axes X, Y, Z pour traduire vos mouvements en METs (ex: &lt; 100 counts = Sédentaire).</p>
			</div>
		</section>

		<section id="equipe" class="content-section text-center">
			<h2>L'Équipe</h2>
			<p>Nous sommes étudiants en filière Système Embarqué, Automatisation et Capteurs (SEA) à Polytech Annecy-Chambéry.</p>
			<ul class="team-list">
				<li>KODAD Amani</li>
				<li>AKOTEGNON Anne-Marie</li>
				<li>MENO Viviane</li>
				<li>COURRET-BONNEFOND Malo</li>
			</ul>
		</section>

		<section id="inscription" class="content-section text-center">
			<h2>Réserver la montre</h2>
			<p>Intéressé(e) par une démonstration ? Écrivez-nous et nous reviendrons vers vous rapidement.</p>
			<a href="mailto:contact@polytech-annecy.fr" class="btn-cta">Nous contacter</a>
		</section>
	</main>

	<!-- <footer>
		<p>&copy; 2028 - Projet Cycle Ingénieur Polytech Annecy-Chambéry</p>
	</footer> -->

	<?php include __DIR__ . '/../../layouts/footer/footer.php'; ?>

</body>
</php>
