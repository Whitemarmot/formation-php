-- Script d'initialisation MySQL pour le projet Formation
-- Ce fichier est exécuté automatiquement au premier démarrage du container

-- Configuration du jeu de caractères
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- Création de la base de données (si elle n'existe pas déjà)
CREATE DATABASE IF NOT EXISTS formation_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Utiliser la base
USE formation_db;

-- Accorder tous les privilèges à l'utilisateur de l'application
GRANT ALL PRIVILEGES ON formation_db.* TO 'formation_user'@'%';
FLUSH PRIVILEGES;

-- Note: Les tables seront créées par les migrations Laravel
-- Ce fichier peut être utilisé pour des données initiales si nécessaire
