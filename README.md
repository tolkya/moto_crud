# 🏍️ Projet Moto CRUD - Environnement LAMP avec Docker

Bienvenue dans ce projet de site web moto développé avec un environnement **LAMP (Linux, Apache, MySQL, PHP)** prêt à l'emploi grâce à Docker.  
Il permet aux visiteurs de consulter des fiches motos et aux utilisateurs inscrits d’ajouter, modifier ou supprimer leurs propres motos via une interface CRUD.

---

## 🚀 Objectif du projet

Ce projet a pour but de :

- Fournir un **site web** avec une page d’accueil affichant les motos enregistrées, accessible à tous.
- Permettre aux utilisateurs de **s’inscrire via un formulaire**.
- Offrir aux utilisateurs connectés un **espace personnel CRUD** :
  - Ajouter leur propre moto.
  - Modifier ou supprimer les motos qu’ils ont ajoutées.
- Proposer un environnement de développement **clé en main** via Docker.

---

## 📦 Contenu du projet

- PHP 8.2 avec Apache
- MySQL 8.0
- phpMyAdmin (interface web de gestion de la base de données)
- Base de données `moto` auto-importée avec des données d’exemple

---

## ⚙️ Installation & Lancement

1. Cloner le dépôt

bash'''

git clone https://github.com/tolkya/moto_crud.git .

docker-compose up -d



2. ▶️ Comment l’utiliser




🌍 Accès
Application web : http://localhost:8080/moto/public/moto.php

phpMyAdmin : http://localhost:8081

Utilisateur : root

Mot de passe : root