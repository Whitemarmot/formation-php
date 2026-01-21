#!/bin/bash

# Script de compilation LaTeX avec watermark
# Usage: compile.sh <fichier.tex> [email] [nom] [commande]

set -e

TEX_FILE="$1"
WATERMARK_EMAIL="${2:-}"
WATERMARK_NAME="${3:-}"
ORDER_NUMBER="${4:-}"
OUTPUT_DIR="/output"

if [ -z "$TEX_FILE" ]; then
    echo "Usage: compile.sh <fichier.tex> [email] [nom] [commande]"
    exit 1
fi

# Extraire le nom de base
BASE_NAME=$(basename "$TEX_FILE" .tex)
DIR_NAME=$(dirname "$TEX_FILE")

echo "=== Compilation de $TEX_FILE ==="

# Changer vers le répertoire du fichier
cd "$DIR_NAME"

# Première passe
echo ">>> Première passe lualatex..."
lualatex -interaction=nonstopmode -shell-escape "$BASE_NAME.tex"

# Deuxième passe pour les références
echo ">>> Deuxième passe lualatex..."
lualatex -interaction=nonstopmode -shell-escape "$BASE_NAME.tex"

# Si un watermark est demandé
if [ -n "$WATERMARK_EMAIL" ]; then
    echo ">>> Ajout du watermark..."

    # Créer le fichier watermark
    WATERMARK_TEXT="Licence accordée à: $WATERMARK_NAME | $WATERMARK_EMAIL | Commande: $ORDER_NUMBER | $(date '+%Y-%m-%d')"

    # Créer un PDF de watermark
    cat > /tmp/watermark.tex << EOF
\\documentclass{article}
\\usepackage[paperwidth=595pt,paperheight=842pt,margin=0pt]{geometry}
\\usepackage{tikz}
\\usepackage{fontspec}
\\setmainfont{Roboto}
\\pagestyle{empty}
\\begin{document}
\\begin{tikzpicture}[remember picture,overlay]
    \\node[rotate=45, scale=3, opacity=0.05, text=gray] at (current page.center) {$WATERMARK_NAME};
    \\node[anchor=south, opacity=0.3, font=\\tiny] at ([yshift=10pt]current page.south) {$WATERMARK_TEXT};
\\end{tikzpicture}
\\end{document}
EOF

    cd /tmp
    lualatex -interaction=nonstopmode watermark.tex

    # Appliquer le watermark à toutes les pages
    cd "$DIR_NAME"
    pdftk "$BASE_NAME.pdf" multistamp /tmp/watermark.pdf output "${BASE_NAME}_watermarked.pdf"

    # Copier vers output
    cp "${BASE_NAME}_watermarked.pdf" "$OUTPUT_DIR/${BASE_NAME}_${ORDER_NUMBER}.pdf"

    echo ">>> PDF watermarké créé: $OUTPUT_DIR/${BASE_NAME}_${ORDER_NUMBER}.pdf"
else
    # Copier le PDF sans watermark
    cp "$BASE_NAME.pdf" "$OUTPUT_DIR/${BASE_NAME}.pdf"
    echo ">>> PDF créé: $OUTPUT_DIR/${BASE_NAME}.pdf"
fi

# Nettoyage
rm -f *.aux *.log *.out *.toc *.lof *.lot *.fls *.fdb_latexmk *.synctex.gz

echo "=== Compilation terminée ==="
