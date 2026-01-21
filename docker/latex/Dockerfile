FROM texlive/texlive:latest

# Installation des outils supplémentaires
RUN apt-get update && apt-get install -y \
    pdftk \
    ghostscript \
    poppler-utils \
    fonts-roboto \
    fonts-noto \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Répertoire de travail
WORKDIR /workspace

# Script de compilation
COPY compile.sh /usr/local/bin/compile.sh
RUN chmod +x /usr/local/bin/compile.sh

# Volume pour les fichiers
VOLUME ["/workspace", "/output"]

# Commande par défaut
CMD ["tail", "-f", "/dev/null"]
