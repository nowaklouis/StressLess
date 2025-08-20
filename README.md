---
# Stress Less - Symfony Project

Ce projet Symfony 7 est configuré pour fonctionner avec **Docker**, et inclut un workflow **CI/CD GitHub Actions** pour automatiser les tests et migrations.
---

## Prérequis

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installé
- [Git](https://git-scm.com/) installé
- Compte GitHub (pour cloner le repo)
- Compte Docker Hub (optionnel, pour pull/push des images)

---

## 1️⃣ Cloner le projet

```bash
git clone https://github.com/devnowa/stress_less.git
cd stress_less
```

---

## 2️⃣ Lancer les conteneurs Docker

Le projet utilise `docker-compose` pour démarrer 3 services :

- `app` : PHP/Symfony
- `web` : Nginx
- `db` : MySQL

```bash
docker compose up -d
```

- Accéder à l’application : [http://localhost:8080](http://localhost:8080)

---

## 3️⃣ Variables d’environnement

Le fichier `.env` contient la configuration locale pour Symfony. Par défaut :

```dotenv
DATABASE_URL="mysql://user:password@db:3306/symfony"
```

- `user` / `password` : identiques à ceux du service MySQL dans `docker-compose.yml`
- `db` : nom du conteneur MySQL pour la connexion depuis Symfony

⚠️ Pour GitHub Actions, la variable `DATABASE_URL` est définie automatiquement dans le workflow.

---

## 4️⃣ Commander Symfony

Exemple de commandes à lancer **dans le conteneur app** :

```bash
docker compose exec app bash
php bin/console doctrine:migrations:migrate
php bin/console cache:clear
```

---

## 5️⃣ Workflow CI/CD GitHub Actions

- Les migrations et tests sont exécutés automatiquement à chaque push ou pull request sur `main`.
- Fichier de workflow : `.github/workflows/ci.yml`

---

## 6️⃣ Docker Hub (optionnel)

Si vous voulez partager l’image Docker prébuildée avec un collègue :

1. Se connecter à Docker Hub :

```bash
docker login
```

2. Taguer l’image :

```bash
docker tag stress_less-app devnowa/stress_less-app:latest
```

3. Pousser l’image :

```bash
docker push devnowa/stress_less-app:latest
```

4. Sur la machine du collègue :

```bash
docker pull devnowa/stress_less-app:latest
docker compose up -d
```

---

## 7️⃣ Arrêter et nettoyer les conteneurs

```bash
docker compose down
docker volume prune  # supprime les volumes MySQL si nécessaire
```
