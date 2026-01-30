# 💰 Cagnotte Pote – Plateforme de cagnotte en ligne (Projet test)

**Cagnotte Pote** est un site de **cagnotte en ligne** développé dans le cadre de ma formation.  
Il permet de créer et gérer des collectes pour des événements comme des **anniversaires**, **pots de départ**, ou toute autre occasion spéciale.

⚠️ **Important : ce site est un projet de démonstration. Aucune transaction réelle ni argent réel n’est utilisé.**

---

## 🚀 Fonctionnalités

### 🌍 Accès public
- Consultation des cagnottes actives
- Visualisation du montant collecté
- Affichage de l’objectif à atteindre
- Suivi de la progression de la cagnotte en temps réel

---

### 🎉 Création de cagnotte
Les utilisateurs peuvent :
- Créer une cagnotte pour un événement (anniversaire, soirée, cadeau commun…)
- Définir un **objectif financier**
- Ajouter une description et une date de fin
- Partager la cagnotte via un lien

---

### 🤝 Participation à une cagnotte
- Participation simple et rapide
- Ajout d’un message lors de la contribution
- Affichage de la liste des participants
- Mise à jour automatique du montant total collecté

---

### 📊 Suivi des contributions
- Barre de progression indiquant l’avancement vers l’objectif
- Nombre de participants
- Historique des contributions

## 🚀 Installation du projet Cagnotte Potes

Suivez ces étapes pour lancer le projet en local :

### 1️⃣ Dans le terminal, Cloner le projet dans le terminal
```bash
git clone https://github.com/Meikaziku/cagnotte-pote.git ./
```

### 2️⃣ Dans le terminal, Installer les dépendances
```bash
composer install
```

### 3️⃣ Dans la racine de ton projet, configurer l’environnement

Copier, coller le fichier .env → .env.local :

```bash
cp .env .env.local
```

Modifier DATABASE_URL :

```bash
DATABASE_URL="mysql://user:password@127.0.0.1:3306/nom_de_la_db?serverVersion=8.0"
```
### 4️⃣ Dans le terminal, Créer la base de données
```bash
symfony console doctrine:database:create
```

### 5️⃣ Dans le terminal, appliquer les migrations
```bash
symfony console doctrine:migrations:migrate
```

### 5️⃣ Dans le terminal, installer Tailwinds
```bash
symfony console doctrine:migrations:migrate
```

### 6️⃣ Dans le terminal, Lancer le serveur local
```bash
symfony server:start
```


Accédez ensuite au site via l'adress fournit par le terminal: http://adresseIp

