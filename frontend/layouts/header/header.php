<?php
// Header include: shows login state if session exists
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <a class="logo" href="/APP2028/2028_Sante/frontend/pages/home/home.php">
        <img src="/APP2028/2028_Sante/frontend/assets/img/logo_Sante2028.jpg" alt="Logo">   
    </a>

    <?php if (!empty($_SESSION['user_name'])): ?>
        <div class="welcome-message">
            Bonjour, <?= htmlspecialchars($_SESSION['user_name']) ?>
        </div>
    <?php endif; ?>

    <nav>
        <ul>
            <li><a href="/APP2028/2028_Sante/frontend/index.php">Accueil</a></li>
            <li><a href="/APP2028/2028_Sante/frontend/pages/team/team.php">Équipe</a></li>
            <li><a href="/APP2028/2028_Sante/frontend/pages/contact/contact.php">Contact</a></li>
            <li><a href="/APP2028/2028_Sante/frontend/pages/reservation/reservation.php">Réservation</a></li>
            
            <?php if (!empty($_SESSION['user_name'])): ?>
                <li><a class="btn-logout" href="/APP2028/2028_Sante/frontend/auth/logout.php">Déconnexion</a></li>
            <?php else: ?>
                <li><a class="btn-connexion" href="/APP2028/2028_Sante/frontend/auth/login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>