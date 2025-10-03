# Utiliser l'image Python 3.11 slim comme base
FROM python:3.11-slim

# Informations du mainteneur
LABEL maintainer="votre-email@example.com"

# Mettre à jour les paquets et installer les dépendances système
RUN apt-get update -y && \
    apt-get install -y python3-dev libsasl2-dev libldap2-dev libssl-dev gcc && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Copier le fichier requirements.txt
COPY requirements.txt /

# Installer les dépendances Python
RUN pip3 install --no-cache-dir -r /requirements.txt

# Copier le code source de l'API
COPY student_age.py /

# Créer le dossier /data pour les données persistantes
RUN mkdir /data

# Déclarer le volume pour les données persistantes
VOLUME /data

# Exposer le port 5000
EXPOSE 5000

# Commande pour exécuter l'application
CMD ["python3", "./student_age.py"]