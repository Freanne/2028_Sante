<!DOCTYPE html>
<html lang="fr">
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
        <p>Le MET est l'unité de mesure de l'intensité de notre dépense énergétique :<br><br>
        Sédentarité : ≤ 1,5 MET<br>
        Activité légère : de 1,5 à 3 METs<br>
        Activité intense : > 6 METs<br><br>
        Données nécessaires à sa détermination :<br><br>
        L'accélération sur 3 axes : pour évaluer l'intensité du mouvement.<br>
        La vitesse angulaire et l'inclinaison : pour définir la posture.<br>
        Le temps : pour mesurer la durée continue de l'effort physique.</p>
    </div>
		</section>
	</main>

	<!-- <footer>
		<p>&copy; 2028 - Projet Cycle Ingénieur Polytech Annecy-Chambéry</p>
	</footer> -->

	<?php include __DIR__ . '/../../layouts/footer/footer.php'; ?>

</body>
</html>
