
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/pages/reservation/reservation.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/assets/styles/main.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/layouts/header/header.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/layouts/footer/footer.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/pages/home/home.css">
</head>
<body class="reservation-body">

<?php include __DIR__ . '/../../layouts/header/header.php'; ?>
    <section class="hero">
        <h1>CONNECTEZ-VOUS À VOTRE SANTÉ</h1>
        <p>Un objet connecté innovant développé par les étudiants de Polytech pour évaluer et améliorer vos habitudes de vie.</p>
    </section>
    <?php
    // Temporary: enable error display to surface issues (remove on production)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // session is started in the header include; do not call session_start() again here

    $conn = mysqli_connect('localhost', 'root', '', '2028_sante');

    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8mb4");

    $msg = "";

// CAS CONFIRMATION DE RÉSERVATION
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_booking'])) {
        if (!isset($_SESSION['user_id'])) {
            $msg = "<p style='color:red; text-align:center;'>Erreur : Vous devez être connecté pour réserver.</p>";
        } else {
            $start_date_str = $_POST['start_date']; 
            $user_id = $_SESSION['user_id'];
    
            $start_date = new DateTime($start_date_str);
            $end_date = clone $start_date;
            $end_date->modify('+6 days');
    
            $start_format = $start_date->format('Y-m-d');
            $end_format = $end_date->format('Y-m-d');
    
            // Vérification des doublons
            $check_sql = "SELECT id FROM reservations WHERE (start_date <= ? AND end_date >= ?)";
            $stmt_check = mysqli_prepare($conn, $check_sql);
            mysqli_stmt_bind_param($stmt_check, "ss", $end_format, $start_format);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);
    
            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                $msg = "<p style='color:red; text-align:center;'>Désolé, cette période est déjà réservée.</p>";
                mysqli_stmt_close($stmt_check);
            } else {
                mysqli_stmt_close($stmt_check);
    
                // Insertion en BDD
                $sql = "INSERT INTO reservations (user_id, start_date, end_date, status) VALUES (?, ?, ?, 'confirmed')";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "iss", $user_id, $start_format, $end_format);
    
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    echo "<script>window.location.href='confirmation.php';</script>";
                    exit();
                } else {
                    $msg = "<p style='color:red; text-align:center;'>Erreur lors de la réservation.</p>";
                }
            }
        }
    }
?>

    <main class="reservation-page">
        <div class="reservation-container">

            <!-- Hero moved above the reservation container to match other pages -->
           
            <!-- Auth removed: reservation page is reservation-only; use /pages/reservation/login.php to authenticate -->

             <!-- <section class="calendar-section">
                <h2>Disponibilités</h2>
                <p class="calendar-subtitle">Sélectionnez votre semaine de prêt</p>
                
                <div class="calendar-nav">
                    <button class="btn btn-icon" id="prev-month">←</button>
                    <span class="current-month">Mai 2026</span>
                    <button class="btn btn-icon" id="next-month">→</button>
                </div>

                <div class="calendar">
                    <div class="calendar-header">
                        <span>Lun</span>
                        <span>Mar</span>
                        <span>Mer</span>
                        <span>Jeu</span>
                        <span>Ven</span>
                        <span>Sam</span>
                        <span>Dim</span>
                    </div>
                    <div class="calendar-grid">
                        <span class="day other-month">27</span>
                        <span class="day other-month">28</span>
                        <span class="day other-month">29</span>
                        <span class="day other-month">30</span>
                        <span class="day">1</span>
                        <span class="day">2</span>
                        <span class="day">3</span>
                        <span class="day available week-start" data-week="2026-05-04">4</span>
                        <span class="day available">5</span>
                        <span class="day available today">6</span>
                        <span class="day available">7</span>
                        <span class="day available">8</span>
                        <span class="day available">9</span>
                        <span class="day available week-end">10</span>
                        <span class="day reserved week-start">11</span>
                        <span class="day reserved">12</span>
                        <span class="day reserved">13</span>
                        <span class="day reserved">14</span>
                        <span class="day reserved">15</span>
                        <span class="day reserved">16</span>
                        <span class="day reserved week-end">17</span>
                        <span class="day available week-start" data-week="2026-05-18">18</span>
                        <span class="day available">19</span>
                        <span class="day available">20</span>
                        <span class="day available">21</span>
                        <span class="day available">22</span>
                        <span class="day available">23</span>
                        <span class="day available week-end">24</span>
                        <span class="day available week-start" data-week="2026-05-25">25</span>
                        <span class="day available">26</span>
                        <span class="day available">27</span>
                        <span class="day available">28</span>
                        <span class="day available">29</span>
                        <span class="day available">30</span>
                        <span class="day available week-end">31</span>
                    </div>
                </div>

                <div class="calendar-legend">
                    <span class="legend-item"><span class="dot available"></span> Disponible</span>
                    <span class="legend-item"><span class="dot reserved"></span> Réservé</span>
                    <span class="legend-item"><span class="dot selected"></span> Sélectionné</span>
                </div>

                <div class="reservation-summary" id="reservation-summary" style="display: none;">
                    <h3>Votre réservation</h3>
                    <p><strong>Période :</strong> <span id="selected-period"></span></p>
                    <p><strong>Durée :</strong> 7 jours</p>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="start_date" id="hidden-start-date" value="">
                        <button type="submit" name="confirm_booking" class="btn btn-primary btn-full">Confirmer la réservation</button>
                    </form>
                </div>
            </section>  -->


            <section class="calendar-section">
    <h2>Disponibilités</h2>
    <p class="calendar-subtitle">Sélectionnez votre semaine de prêt (7 jours à partir du lundi)</p>
            <div class="calendar-wrapper">
    
    <?php
    // 1. Détection dynamique du mois et de l'année via l'URL (par défaut : mois et année actuels)
    $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
    $year = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

    // Calcul des mois précédent et suivant pour les flèches de navigation
    $prev_month = $month - 1;
    $prev_year = $year;
    if ($prev_month == 0) {
        $prev_month = 12;
        $prev_year--;
    }

    $next_month = $month + 1;
    $next_year = $year;
    if ($next_month == 13) {
        $next_month = 1;
        $next_year++;
    }

    // Tableau des mois en français
    $month_names = [1 => "Janvier", 2 => "Février", 3 => "Mars", 4 => "Avril", 5 => "Mai", 6 => "Juin", 7 => "Juillet", 8 => "Août", 9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Décembre"];

    // 2. Récupération des réservations en base de données
    $booked_days = [];
    $query = "SELECT start_date, end_date FROM reservations WHERE status = 'confirmed'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $start = new DateTime($row['start_date']);
        $end = new DateTime($row['end_date']);
        
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end->modify('+1 day'));
        
        foreach ($period as $date) {
            $booked_days[] = $date->format('Y-m-d');
        }
    }

    // 3. Calcul de la structure du mois demandé
    $first_day_of_month = mktime(0, 0, 0, $month, 1, $year);
    $number_days = date('t', $first_day_of_month); 
    $date_components = getdate($first_day_of_month);
    
    $day_of_week = $date_components['wday'];
    if ($day_of_week == 0) { $day_of_week = 7; } // Ajustement Dimanche = 7
    ?>

    <div class="calendar-nav">
        <a href="?month=<?= $prev_month ?>&year=<?= $prev_year ?>" class="btn btn-icon" id="prev-month">←</a>
        <span class="current-month"><?= $month_names[$month] . " " . $year ?></span>
        <a href="?month=<?= $next_month ?>&year=<?= $next_year ?>" class="btn btn-icon" id="next-month">→</a>
    </div>

        <div class="calendar">
        <div class="calendar-header">
            <span>Lun</span><span>Mar</span><span>Mer</span><span>Jeu</span><span>Ven</span><span>Sam</span><span>Dim</span>
        </div>

        <div class="calendar-grid">
            <?php
            // Cases vides pour le début du mois
            for ($i = 1; $i < $day_of_week; $i++) {
                echo '<span class="day other-month"></span>';
            }

            // Génération des jours du mois sélectionné
            for ($current_day = 1; $current_day <= $number_days; $current_day++) {
                
                $current_date_str = sprintf("%04d-%02d-%02d", $year, $month, $current_day);
                $day_pos = date('N', strtotime($current_date_str));

                if (in_array($current_date_str, $booked_days)) {
                    $class = "reserved";
                } else {
                    $class = "available";
                    if ($day_pos == 1) {
                        $class .= " week-start";
                    }
                }

                echo '<span class="day ' . $class . '" data-week="' . $current_date_str . '">' . $current_day . '</span>';
            }
            ?>
        </div>
    </div>

    <div class="calendar-legend">
        <span class="legend-item"><span class="dot available"></span> Disponible</span>
        <span class="legend-item"><span class="dot reserved"></span> Réservé</span>
        <span class="legend-item"><span class="dot selected"></span> Sélectionné</span>
    </div>
    </div>

    <div class="reservation-summary" id="reservation-summary" style="display: none;">
        <h3>Votre réservation</h3>
        <p><strong>Période :</strong> <span id="selected-period"></span></p>
        <p><strong>Durée :</strong> 7 jours</p>
        
        <form method="POST" action="">
            <input type="hidden" name="start_date" id="hidden-start-date" value="">
            <button type="submit" name="confirm_booking" class="btn btn-primary btn-full">Confirmer la réservation</button>
        </form>
    </div>
</section>
        </div> 
    </main>

    <script>
        let dateDebutSelectionnee = "";

        document.querySelectorAll('.day.available.week-start').forEach(day => {
    day.addEventListener('click', () => {
        // Réinitialiser toutes les sélections précédentes
        document.querySelectorAll('.day').forEach(d => d.classList.remove('selected'));
        
        const weekStart = day.dataset.week;
        document.getElementById('hidden-start-date').value = weekStart;
        
        // Sélectionner visuellement les 7 jours de la semaine de prêt
        let current = day;
        for (let i = 0; i < 7; i++) {
            if (current && current.classList.contains('day') && !current.classList.contains('other-month')) {
                current.classList.add('selected');
                current = current.nextElementSibling;
            }
        }
        
        document.getElementById('selected-period').textContent = weekStart + ' → 7 jours';
        document.getElementById('reservation-summary').style.display = 'block';
    });
});
    </script>
</body>
</html>