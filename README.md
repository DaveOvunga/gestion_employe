# 📁 Application RH — Gestion des Employés

Une application Laravel dédiée à la gestion des employés, des congés et du suivi RH.  
Elle permet aux administrateurs, responsables RH, managers et employés d’interagir efficacement dans un environnement structuré.

---

## 🚀 Fonctionnalités

### 👤 Employé
- Consulter et modifier son profil
- Demander un congé
- Visualiser ses absences
- Suivre l’historique de ses congés
- Voir les membres de son département et son manager
- Vérifier son statut RH (congés utilisés, en attente, restants)
- Recevoir des notifications internes

### 🧑‍💼 RH / Admin / Manager
- Gérer les utilisateurs et les rôles
- Valider ou rejeter les demandes de congé
- Consulter les demandes par département
- Visualiser les absences des employés
- Assigner des managers ou départements
- Ajouter des notifications internes

---

## 🛠️ Technologies

- **Framework** : Laravel 10+
- **Base de données** : MySQL
- **Gestion des rôles** : [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
- **Authentification** : Laravel Breeze / Fortify (selon config)
- **Interface** : Blade + Bootstrap

---

## ⚙️ Installation

```bash
git clone https://github.com/ton-utilisateur/gestion-employes.git
cd gestion-employes

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed

php artisan serve
