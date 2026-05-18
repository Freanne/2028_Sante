# 2028_Sante

Site de présentation de notre projet consistant en la création d'un dispositif mesurant la sédentarité.

## Arborescence du Projet

```text
PROJET_2028_SANTE/
│
├── .env                            # Variables confidentielles (BDD, API)
├── .gitignore                      # Exclusion de .env et logs
├── README.md                       # Documentation Globale + Arborescence
│
├── backend/                        # --- LOGIQUE PHP ---
│   ├── README.md                   # Documentation technique
│   ├── core/
│   │   ├── config.php              # Chargement du .env
│   │   └── db.php                  # Connexion PDO
│   ├── auth/
│   │   ├── login.php
│   │   ├── register.php
│   │   └── reset.php
│   └── vital_check/
│       ├── calculate_met.php       # VM = √(x²+y²+z²)
│       ├── save_activity.php       # Enregistrement scores/avis
│       └── export_pdf.php          # Générateur de rapports
│
└── frontend/                       # --- INTERFACE ---
        ├── index.html                  # Point d'entrée principal
        ├── README.md                   # Documentation UI/UX
        ├── assets/                     # Ressources partagées
        │   ├── css/
        │   │   └── main.css            # Styles communs (Reset, Couleurs, Typo)
        │   └── img/
        │       ├── logo_projet.png
        │       └── device/             # Visuels du produit
        ├── layouts/                    # Structure fixe (header/footer)
        │   ├── head.html
        │   ├── header.html
        │   └── footer.html
        └── pages/                      # --- DOSSIERS PAR PAGE ---
                ├── home/
                │   ├── home.html
                │   └── home.css
                ├── device/
                │   ├── device.html
                │   └── device.css
                ├── team/
                │   ├── team.html
                │   └── team.css
                ├── contact/
                │   ├── contact.html
                │   └── contact.css
                ├── login/
                │   ├── login.html
                │   └── login.css
                ├── register/
                │   ├── register.html
                │   └── register.css
                ├── reset_password/
                │   ├── reset_password.html
                │   └── reset_password.css
                
```
