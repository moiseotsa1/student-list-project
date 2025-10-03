# Student List Project - Docker Infrastructure

## 📋 Description
Ce projet démontre la containerisation d'une application multi-services avec Docker, incluant une API Flask et un frontend PHP, avec déploiement d'un registry Docker privé.

## 🏗️ Architecture
- **API Flask** (Python) - Service REST avec authentification basique
- **Frontend PHP/Apache** - Interface utilisateur web
- **Registry Docker privé** - Gestion des images Docker
- **Réseau Docker** - Communication inter-conteneurs

## 🚀 Déploiement

### Développement
```bash
docker-compose up -d