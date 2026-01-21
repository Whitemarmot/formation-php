<?php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formations = [
            [
                'name' => 'Soudeuse à Points - Les Fondamentaux',
                'slug' => 'fondamentaux',
                'subtitle' => 'Comprendre, choisir et réussir ses premières soudures',
                'description' => $this->getDescription(1),
                'short_description' => 'Formation complète pour débuter le soudage par points. Physique du procédé, choix des équipements, paramètres fondamentaux et premiers exercices pratiques.',
                'level' => 1,
                'price' => 49.00,
                'sale_price' => null,
                'pdf_path' => 'formations/pdfs/formation-niveau-1.pdf',
                'page_count' => 80,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 1,
                'table_of_contents' => $this->getTableOfContents(1),
                'meta_title' => 'Formation Soudage par Points - Niveau Débutant | Fondamentaux',
                'meta_description' => 'Apprenez les bases du soudage par points avec cette formation complète. Physique du procédé, choix des équipements et exercices pratiques.',
            ],
            [
                'name' => 'Soudeuse à Points - Maîtrise Avancée',
                'slug' => 'maitrise',
                'subtitle' => 'Optimisation, batteries lithium et production en série',
                'description' => $this->getDescription(2),
                'short_description' => 'Optimisez vos paramètres, maîtrisez le soudage de batteries lithium et mettez en place un contrôle qualité rigoureux.',
                'level' => 2,
                'price' => 99.00,
                'sale_price' => null,
                'pdf_path' => 'formations/pdfs/formation-niveau-2.pdf',
                'page_count' => 120,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
                'table_of_contents' => $this->getTableOfContents(2),
                'meta_title' => 'Formation Soudage par Points - Niveau Intermédiaire | Maîtrise',
                'meta_description' => 'Perfectionnez vos compétences en soudage par points. Optimisation des paramètres, soudage de batteries lithium et contrôle qualité.',
            ],
            [
                'name' => 'Soudeuse à Points - Excellence Industrielle',
                'slug' => 'excellence',
                'subtitle' => 'Ingénierie avancée, automatisation et certification',
                'description' => $this->getDescription(3),
                'short_description' => 'Formation expert pour ingénieurs et industriels. Dimensionnement électrique, automatisation, normes et certification des procédés.',
                'level' => 3,
                'price' => 199.00,
                'sale_price' => null,
                'pdf_path' => 'formations/pdfs/formation-niveau-3.pdf',
                'page_count' => 150,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 3,
                'table_of_contents' => $this->getTableOfContents(3),
                'meta_title' => 'Formation Soudage par Points - Niveau Expert | Excellence Industrielle',
                'meta_description' => 'Formation expert en soudage par points. Dimensionnement électrique, automatisation, normes ISO et certification des procédés industriels.',
            ],
        ];

        foreach ($formations as $data) {
            Formation::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }

    /**
     * Get description for a formation level.
     */
    private function getDescription(int $level): string
    {
        return match ($level) {
            1 => <<<'HTML'
<h2>Objectifs de la formation</h2>
<p>Cette formation vous permettra de comprendre les principes fondamentaux du soudage par résistance et de réaliser vos premières soudures de qualité.</p>

<h3>Ce que vous apprendrez</h3>
<ul>
    <li>La physique du soudage par résistance (loi de Joule, zones de fusion)</li>
    <li>Les 4 paramètres fondamentaux : courant, temps, force, résistance</li>
    <li>Comment choisir votre équipement selon votre budget et vos besoins</li>
    <li>Le choix et l'entretien des électrodes</li>
    <li>Les règles de sécurité essentielles</li>
    <li>Le diagnostic des 10 défauts les plus courants</li>
</ul>

<h3>Public cible</h3>
<p>Cette formation s'adresse aux débutants sérieux, aux makers et à tous ceux qui souhaitent acquérir des bases solides en soudage par points.</p>

<h3>Prérequis</h3>
<p>Aucun prérequis technique. Seule la motivation est nécessaire.</p>
HTML,
            2 => <<<'HTML'
<h2>Objectifs de la formation</h2>
<p>Perfectionnez vos compétences et passez à un niveau semi-professionnel avec des techniques avancées d'optimisation et de contrôle qualité.</p>

<h3>Ce que vous apprendrez</h3>
<ul>
    <li>Construire et utiliser les diagrammes de soudabilité (lobes de soudure)</li>
    <li>Appliquer la méthode DOE pour optimiser vos paramètres</li>
    <li>Maîtriser le soudage de batteries lithium (18650, 21700, pouch)</li>
    <li>Travailler avec des matériaux avancés (cuivre, assemblages hétérogènes)</li>
    <li>Mettre en place un plan de contrôle qualité</li>
    <li>Organiser une production en petite série</li>
</ul>

<h3>Public cible</h3>
<p>Techniciens, professionnels du secteur et makers avancés souhaitant produire en petite série.</p>

<h3>Prérequis</h3>
<p>Connaissance des fondamentaux du soudage par points (Niveau 1 ou équivalent).</p>
HTML,
            3 => <<<'HTML'
<h2>Objectifs de la formation</h2>
<p>Formation de niveau ingénieur pour concevoir, dimensionner et certifier des installations de soudage industrielles.</p>

<h3>Ce que vous apprendrez</h3>
<ul>
    <li>Dimensionner le circuit électrique (transformateurs, condensateurs, MFDC)</li>
    <li>Concevoir des cellules de soudage automatisées</li>
    <li>Utiliser la simulation par éléments finis</li>
    <li>Appliquer les normes ISO 14373, AWS C1.1 et les standards automobiles</li>
    <li>Qualifier un procédé et rédiger la documentation qualité</li>
    <li>Résoudre des problèmes complexes avec des méthodes expertes</li>
</ul>

<h3>Public cible</h3>
<p>Ingénieurs, responsables techniques et industriels impliqués dans des projets de production à grande échelle.</p>

<h3>Prérequis</h3>
<p>Maîtrise des niveaux 1 et 2, ou expérience équivalente en milieu industriel.</p>
HTML,
            default => '',
        };
    }

    /**
     * Get table of contents for a formation level.
     */
    private function getTableOfContents(int $level): array
    {
        return match ($level) {
            1 => [
                ['title' => 'Introduction', 'page' => 1],
                ['title' => 'Module 1 : Physique du soudage par résistance', 'page' => 5, 'children' => [
                    ['title' => '1.1 Principe de la soudure par résistance', 'page' => 5],
                    ['title' => '1.2 Les 4 paramètres fondamentaux', 'page' => 12],
                    ['title' => '1.3 Métallurgie simplifiée', 'page' => 20],
                ]],
                ['title' => 'Module 2 : Équipements et composants', 'page' => 25, 'children' => [
                    ['title' => '2.1 Anatomie d\'une soudeuse à points', 'page' => 25],
                    ['title' => '2.2 Comparatif des technologies', 'page' => 32],
                    ['title' => '2.3 Soudeuses DIY vs industrielles', 'page' => 38],
                ]],
                ['title' => 'Module 3 : Choix des électrodes', 'page' => 42],
                ['title' => 'Module 4 : Premiers pas pratiques', 'page' => 52],
                ['title' => 'Module 5 : Diagnostic des défauts', 'page' => 65],
                ['title' => 'Annexes', 'page' => 75],
            ],
            2 => [
                ['title' => 'Introduction', 'page' => 1],
                ['title' => 'Module 6 : Optimisation des paramètres', 'page' => 5, 'children' => [
                    ['title' => '6.1 Fenêtre de soudabilité', 'page' => 5],
                    ['title' => '6.2 Méthode DOE', 'page' => 18],
                    ['title' => '6.3 Influence des conditions ambiantes', 'page' => 28],
                ]],
                ['title' => 'Module 7 : Soudage de batteries lithium', 'page' => 35, 'children' => [
                    ['title' => '7.1 Spécificités des cellules', 'page' => 35],
                    ['title' => '7.2 Configurations de packs', 'page' => 45],
                    ['title' => '7.3 Protocoles de soudure batterie', 'page' => 55],
                    ['title' => '7.4 Études de cas', 'page' => 65],
                ]],
                ['title' => 'Module 8 : Matériaux avancés', 'page' => 75],
                ['title' => 'Module 9 : Contrôle qualité', 'page' => 90],
                ['title' => 'Module 10 : Production en petite série', 'page' => 105],
                ['title' => 'Annexes', 'page' => 115],
            ],
            3 => [
                ['title' => 'Introduction', 'page' => 1],
                ['title' => 'Module 11 : Dimensionnement électrique', 'page' => 5, 'children' => [
                    ['title' => '11.1 Calcul de puissance requise', 'page' => 5],
                    ['title' => '11.2 Conception du circuit primaire', 'page' => 15],
                    ['title' => '11.3 Transformateurs de soudage', 'page' => 25],
                    ['title' => '11.4 Systèmes à condensateurs', 'page' => 35],
                    ['title' => '11.5 Technologie MFDC', 'page' => 45],
                ]],
                ['title' => 'Module 12 : Automatisation', 'page' => 55],
                ['title' => 'Module 13 : Simulation et modélisation', 'page' => 80],
                ['title' => 'Module 14 : Normes et certification', 'page' => 100, 'children' => [
                    ['title' => '14.1 Panorama normatif', 'page' => 100],
                    ['title' => '14.2 Qualification du procédé', 'page' => 110],
                    ['title' => '14.3 Qualification du personnel', 'page' => 120],
                    ['title' => '14.4 Documentation qualité', 'page' => 125],
                ]],
                ['title' => 'Module 15 : Troubleshooting expert', 'page' => 130],
                ['title' => 'Annexes', 'page' => 145],
            ],
            default => [],
        };
    }
}
