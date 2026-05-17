<!-- reservation.php -->
<!DOCTYPE php>
<php lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="santee.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/assets/styles/main.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/layouts/header/header.css">
    <link rel="stylesheet" href="/APP2028/2028_Sante/frontend/layouts/footer/footer.css">
	<link rel="stylesheet" href="home.css">
</head>
<body>

<?php include __DIR__ . '/../../layouts/header/header.php'; ?>
    <main class="reservation-page">
        <div class="reservation-container">
           
            <section class="auth-section">
                <div class="tabs">
                    <button class="tab active" data-tab="login">Connexion</button>
                    <button class="tab" data-tab="register">Inscription</button>
                </div>

            
                 <?php
            session_start();

            // if (!isset($_SESSION['user_id'])) {
            //     die("Erreur : Vous devez être connecté pour réserver la montre.");
            // }

            $conn = mysqli_connect('localhost', 'root', '', '2028_sante');

            if (!$conn) {
                die("Erreur de connexion : " . mysqli_connect_error());
            }

            mysqli_set_charset($conn, "utf8mb4");

            $msg = "";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                // CAS INSCRIPTION
                if (isset($_POST['register_btn'])) {

                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $checkEmail = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
                    
                    if (mysqli_num_rows($checkEmail) > 0) {
                        $msg = "<p style='color:red; text-align:center;'>Cet email est déjà utilisé.</p>";
                    } else {
                        // CORRECTION ICI : full_name et password_hash pour coller à ton image
                        $sql = "INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);
                        
                        if (mysqli_stmt_execute($stmt)) {
                            $msg = "<p style='color:green; text-align:center;'>Compte créé ! Connectez-vous.</p>";
                        } else {
                            $msg = "<p style='color:red; text-align:center;'>Erreur SQL : " . mysqli_error($conn) . "</p>";
                        }
                        mysqli_stmt_close($stmt);
                    }
                }

                // CAS CONNEXION
                if (isset($_POST['login_btn'])) {
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = $_POST['password'];

                    $sql = "SELECT * FROM users WHERE email = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $user = mysqli_fetch_assoc($result);

                    // password_hash et full_name
                    if ($user && password_verify($password, $user['password_hash'])) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_name'] = $user['full_name'];
                        $msg = "<p style='color:green; text-align:center;'>Bienvenue " . phpspecialchars($user['full_name']) . " !</p>";
                        echo "<script>window.location.href='confirmation.php';</script>";
                        exit();
                    } else {
                        $msg = "<p style='color:red; text-align:center;'>Identifiants invalides.</p>";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            
            if (isset($_POST['confirm_booking'])) {
                if (!isset($_SESSION['user_id'])) {
    
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
            
                        // Insertion
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
        }
        ?>
         <?= $msg; // Affichage des messages d'erreur ou de succès ?>
                <form method="POST" id="login-form" class="auth-form active">
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" name="email" id="login-email" required placeholder="vous@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="login-password">Mot de passe</label>
                        <input type="password" name="password" id="login-password" required placeholder="••••••••">
                    </div>
                    <button type="submit" name="login_btn" class="btn btn-primary btn-full">Se connecter</button>
                </form>
               
                <form method="POST" id="register-form" class="auth-form">
                    <div class="form-group">
                        <label for="register-name">Nom complet</label>
                        <input type="text" name="name" id="register-name" required placeholder="Marie Dupont">
                    </div>
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" name="email" id="register-email" required placeholder="vous@exemple.com">
                    </div>
                    <div class="form-group">
                        <label for="register-password">Mot de passe</label>
                        <input type="password" name="password" id="register-password" required placeholder="Min. 8 caractères">
                    </div>
                    <button type="submit" name="register_btn" class="btn btn-primary btn-full">Créer mon compte</button>
                </form>
            </section>

             <section class="calendar-section">
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
                        Semaine 1 
                        <span class="day other-month">27</span>
                        <span class="day other-month">28</span>
                        <span class="day other-month">29</span>
                        <span class="day other-month">30</span>
                        <span class="day">1</span>
                        <span class="day">2</span>
                        <span class="day">3</span>
                        Semaine 2 
                        <span class="day available week-start" data-week="2026-05-04">4</span>
                        <span class="day available">5</span>
                        <span class="day available today">6</span>
                        <span class="day available">7</span>
                        <span class="day available">8</span>
                        <span class="day available">9</span>
                        <span class="day available week-end">10</span>
                       Semaine 3 - réservée
                        <span class="day reserved week-start">11</span>
                        <span class="day reserved">12</span>
                        <span class="day reserved">13</span>
                        <span class="day reserved">14</span>
                        <span class="day reserved">15</span>
                        <span class="day reserved">16</span>
                        <span class="day reserved week-end">17</span>
                         Semaine 4 
                        <span class="day available week-start" data-week="2026-05-18">18</span>
                        <span class="day available">19</span>
                        <span class="day available">20</span>
                        <span class="day available">21</span>
                        <span class="day available">22</span>
                        <span class="day available">23</span>
                        <span class="day available week-end">24</span>
                         Semaine 5 
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

                <!-- <div class="reservation-summary" id="reservation-summary" style="display: none;">
                    <h3>Votre réservation</h3>
                    <p><strong>Période :</strong> <span id="selected-period"></span></p>
                    <p><strong>Durée :</strong> 7 jours</p>
                    <button class="btn btn-primary btn-full" name="confirm_booking" id="confirm-reservation">Confirmer la réservation</button>
                </div> -->

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
        // Gestion des onglets connexion/inscription
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab + '-form').classList.add('active');
            });
        });

        let dateDebutSelectionnee = "";
        // Sélection de semaine
        document.querySelectorAll('.day.available.week-start').forEach(day => {
            day.addEventListener('click', () => {
                document.querySelectorAll('.day').forEach(d => d.classList.remove('selected'));
                const weekStart = day.dataset.week;
                dateDebutSelectionnee = weekStart;
                let current = day;
                for (let i = 0; i < 7 && current; i++) {
                    current.classList.add('selected');
                    current = current.nextElementSibling;
                }
                document.getElementById('selected-period').textContent = weekStart + ' → 7 jours';
                document.getElementById('reservation-summary').style.display = 'block';
            });
        });

        document.getElementById('confirm-reservation').addEventListener('click', () => {
            if (!dateDebutSelectionnee) {
                alert("Veuillez sélectionner une semaine sur le calendrier.");
                return;
            }
            
            // Redirection vers le script PHP de traitement avec la date en paramètre URL
            window.location.href = 'traiter_reservation.php?start_date=' + dateDebutSelectionnee;
        });
    </script>
</body>
</php>
