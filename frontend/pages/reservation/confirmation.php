<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: reservation.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation Confirmée</title>
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/pages/reservation/reservation.css">
    <style>
        .success-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            text-align: center;
            max-width: 500px;
            margin: 100px auto;
            border-top: 5px solid var(--accent-emerald);
        }
        h1 { color: var(--primary-blue); }
        .checkmark { color: var(--accent-emerald); font-size: 4rem; margin-bottom: 20px; }
        .btn-home { display: inline-block; margin-top: 25px; padding: 12px 25px; background: var(--primary-blue); color: white; text-decoration: none; border-radius: 8px; }
    </style>
</head>
<body>

    <div class="success-box">
        <div class="checkmark">✓</div>
        <h1>Félicitations, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</h1>
        <p>Votre réservation pour l'unique montre de diagnostic de la sédentarité a bien été enregistrée.</p>
        <p>Un membre de l'équipe Polytech vous contactera pour la remise du dispositif.</p>
        
        <a href="../../index.php" class="btn-home">Retour à l'accueil</a>
    </div>

</body>
</html>