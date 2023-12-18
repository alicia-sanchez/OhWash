<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use App\Entity\CategoryService;
use App\Entity\Service;
use App\Entity\CategoryArticle; 
use App\Entity\Article; 
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    private const CATEGORIES_SERVICES = [
        'pressing' => [
            'name' => 'pressing',
            'description' => 'Pour des vêtements et tissus délicats.',
            'information' => 'Laver + Repassage + sur cintre'
        ],
        'blanchisserie' => [
            'name' => 'blanchisserie',
            'description' => 'Services de lavage, séchage et pliage pour votre linge quotidien.',
            'information' => 'Laver + Secher au sèche-linge + dans un sac'
        ],
        'ameublement' => [
            'name' => 'ameublement',
            'description' => 'Pour les articles plus volumineux qui nécessitent des soins supplémentaires.',
            'information' => 'Nettoyage personnalisé'
        ],
        'retouche' => [
            'name' => 'retouche',
            'description' => 'Ajustements et modifications sur mesure.',
            'information' => 'Voir directement avec nos professionnels'
        ]
    ];


    private const SERVICES = [
        'nettoyage à sec' => [
            'name' => 'Nettoyage à sec',
            'description' => 'Nettoyage doux sans produits chimiques agressifs, préservant la qualité de vos tissus et de l\'environnement.',
            'price' => 6,
            'category' => 'pressing'
        ],
        'nettoyage de tissus délicats' => [
            'name' => 'Nettoyage de tissus délicats',
            'description' => 'Nettoyage doux sans produits chimiques agressifs, préservant la qualité de vos tissus et de l\'environnement.',
            'price' => 8,
            'category' => 'pressing'
        ],
        'repassage' => [
            'name' => 'Repassage',
            'description' => 'description à venir.',
            'price' => 7,
            'category' => 'pressing'
        ],
        'lavage de linge de maison' => [
            'name' => 'Lavage de linge de maison',
            'description' => 'Fraîcheur et propreté écologique pour tous vos textiles de maison.',
            'price' => 10,
            'category' => 'blanchisserie'
        ],
        'traitement anti-tâche et désinfection' => [
            'name' => 'Traitement anti-tâche et désinfection',
            'description' => 'Élimination des taches tenaces et désinfection pour une propreté impeccable.',
            'price' => 8,
            'category' => 'blanchisserie'
        ],
        'lavage et pliage de linge au kilo' => [
            'name' => 'Lavage et pliage de linge au kilo',
            'description' => 'Utilisation d\'eau recyclée et de détergents écologiques pour nettoyer votre linge de manière durable.',
            'price' => 12,
            'category' => 'blanchisserie'
        ],
        'nettoyage rideaux et voilages' => [
            'name' => 'Nettoyage rideaux et voilages',
            'description' => 'Soin délicat pour éliminer la poussière et les odeurs, tout en préservant la qualité des tissus.',
            'price' => 10,
            'category' => 'ameublement'
        ],
        'nettoyage de tapis et moquettes' => [
            'name' => 'Nettoyage de tapis et moquettes',
            'description' => 'Un service de nettoyage en profondeur qui utilise des composés entièrement naturels.',
            'price' => 20,
            'category' => 'ameublement'
        ],
        'aujustement de taille pour vêtements' => [
            'name' => 'Aujustement de taille pour vêtements',
            'description' => 'Modification précise de vos vêtements pour un ajustement parfait à votre silhouette.',
            'price' => 8,
            'category' => 'retouche'
        ],
        'réparation de déchirures et remplacement de fermetures éclairs' => [
            'name' => 'Réparation de déchirures et remplacement de fermetures éclairs',
            'description' => 'Chaque intervention vise à prolonger la durée de vie de vos pièces avec des matériaux recyclés ou réutilisés.',
            'price' => 8,
            'category' => 'retouche'
        ],
        'customisation et modification pour vêtements' => [
            'name' => 'Customisation et modification pour vêtements',
            'description' => 'Personnalisation créative pour renouveler et adapter vos pièces à votre style unique.',
            'price' => 12,
            'category' => 'retouche'
        ],
    ];

    private const CATEGORIES_ARTICLES = [
        'vetement_exterieur' => 'Vêtement d\'extérieur',
        'tenue_quotidien' => 'Tenue de tous les jours',
        'vetement_delicat' => 'Vêtement délicats',
        'tenue_soiree' => 'Tenue de soirée',
        'accessoires' => 'Accessoires',
        'linge_maison' => 'Linge de maison',
        'bains' => 'Bains',
        'linge_cuisine' => 'Linge de cuisine',
        'rideaux_voilages' => 'Rideaux et Voilages',
        'mobilier' => 'Mobilier',
        'ajustements' => 'Ajustements',
        'reparations' => 'Réparations',
        'personnalisations' => 'Personnalisations',
    ];

    private const ARTICLES = [
        'veste' => [
            'name' => 'Veste',
            'categoryArticle' => 'vetement_exterieur',
            'service' => ['nettoyage_a_sec'],
            'price' => 13,
        ],
        'impermeable' => [
            'name' => 'Imperméable',
            'categoryArticle' => 'vetement_exterieur',
            'service' => ['nettoyage_a_sec'],
            'price' => 10,
        ],
        'doudoune' => [
            'name' => 'Doudoune',
            'categoryArticle' => 'vetement_exterieur',
            'service' => ['nettoyage_a_sec'],
            'price' => 15,
        ],
        'blouson_parka' => [
            'name' => 'Blouson / Parka',
            'categoryArticle' => 'vetement_exterieur',
            'service' => ['nettoyage_a_sec'],
            'price' => 15,
        ],
        'pull' => [
            'name' => 'Pull',
            'categoryArticle' => 'tenue_quotidien',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 6,
        ],
        'tshirt' => [
            'name' => 'T-shirt',
            'categoryArticle' => 'tenue_quotidien',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 4,
        ],
        'pantalon' => [
            'name' => 'Pantalon',
            'categoryArticle' => 'tenue_quotidien',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 5,
        ],
        'jean' => [
            'name' => 'Jean',
            'categoryArticle' => 'tenue_quotidien',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 5,
        ],
        'short' => [
            'name' => 'Short',
            'categoryArticle' => 'tenue_quotidien',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 4,
        ],
        'robe' => [
            'name' => 'Robe',
            'categoryArticle' => 'tenue_quotidien',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 6,
        ],
        'chemisier_soie' => [
            'name' => 'Chemisier en soie',
            'categoryArticle' => 'vetement_delicat',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 6,
        ],
        'pantalon_cuir' => [
            'name' => 'Pantalon en cuir',
            'categoryArticle' => 'vetement_delicat',
            'service' => ['nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 5,
        ],
        'pull_cachemire' => [
            'name' => 'Pull en cachemire',
            'categoryArticle' => 'vetement_delicat',
            'service' => ['nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 6,
        ],
        'chemisier_dentelle' => [
            'name' => 'Chemisier en dentelle',
            'categoryArticle' => 'vetement_delicat',
            'service' => ['nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 5,
        ],
        'costume_2_pieces' => [
            'name' => 'Costume (2 pièces)',
            'categoryArticle' => 'tenue_soiree',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 5,
        ],
        'costume_3_pieces' => [
            'name' => 'Costume (3 pièces)',
            'categoryArticle' => 'tenue_soiree',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 5,
        ],
        'robe_soiree' => [
            'name' => 'Robe de soirée',
            'categoryArticle' => 'tenue_soiree',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 8,
        ],
        'foulard_echarpe' => [
            'name' => 'Foulard / Echarpe',
            'categoryArticle' => 'accessoires',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 4,
        ],
        'cravate_noed_papillon' => [
            'name' => 'Cravate / Noeud papillon',
            'categoryArticle' => 'accessoires',
            'service' => ['repassage', 'nettoyage_a_sec', 'nettoyage_tissus_delicats'],
            'price' => 4,
        ],
        'chaussettes_sousvetements' => [
            'name' => 'Chaussettes / Sous-vêtements',
            'categoryArticle' => 'accessoires',
            'service' => ['repassage', 'nettoyage_a_sec'],
            'price' => 4,
        ],
        'drap_simple' => [
            'name' => 'Drap - Simple',
            'categoryArticle' => 'linge_maison',
            'service' => ['repassage', 'lavage_linge_maison', 'traitement_anti_tache', 'lavage_pliage_kilo'],
            'price' => 4,
        ],
        'drap_double' => [
            'name' => 'Drap - Double',
            'categoryArticle' => 'linge_maison',
            'service' => ['repassage', 'lavage_linge_maison', 'traitement_anti_tache', 'lavage_pliage_kilo'],
            'price' => 5,
        ],
        'housse_couette_simple' => [
            'name' => 'Housse de couette - Simple',
            'categoryArticle' => 'linge_maison',
            'service' => ['repassage', 'lavage_linge_maison', 'traitement_anti_tache', 'lavage_pliage_kilo'],
            'price' => 5,
        ],
        'housse_couette_double' => [
            'name' => 'Housse de couette - Double',
            'categoryArticle' => 'linge_maison',
            'service' => ['repassage', 'lavage_linge_maison', 'traitement_anti_tache', 'lavage_pliage_kilo'],
            'price' => 8,
        ],
        'taie_d\'oreiller' => [
            'name' => 'Taie d\'oreiller',
            'categoryArticle' => 'linge_maison', 
            'service' => ['repassage', 'lavage_linge_maison', 'traitement_anti_tache', 'lavage_pliage_kilo'],
            'price' => 3,
        ],
        'housse_de_coussin' => [
            'name' => 'Housse de coussin',
            'categoryArticle' => 'linge_maison',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection', 'Lavage et pliage de linge au kilo'],
            'price' => 4,
        ],
        'tapis_de_bain' => [
            'name' => 'Tapis de bain',
            'categoryArticle' => 'bains',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection', 'Lavage et pliage de linge au kilo'],
            'price' => 4,
        ],
        'serviette_de_bain' => [
            'name' => 'Serviette de bain',
            'categoryArticle' => 'bains',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection', 'Lavage et pliage de linge au kilo'],
            'price' => 4,
        ],
        'serviette_de_toilette' => [
            'name' => 'Serviette de toilette',
            'categoryArticle' => 'bains',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection', 'Lavage et pliage de linge au kilo'],
            'price' => 4,
        ],
        'peignoir_de_bain' => [
            'name' => 'Peignoir de bain',
            'categoryArticle' => 'bains',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection', 'Lavage et pliage de linge au kilo'],
            'price' => 5,
        ],
        'nappe_2m' => [
            'name' => 'Nappe (2m)',
            'categoryArticle' => 'linge_cuisine',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection'],
            'price' => 5,
        ],
        'nappe_4m' => [
            'name' => 'Nappe (4m)',
            'categoryArticle' => 'linge_cuisine',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection'],
            'price' => 6,
        ],
        'serviette_de_table' => [
            'name' => 'Serviette de table',
            'categoryArticle' => 'linge_cuisine',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection', 'Lavage et pliage de linge au kilo'],
            'price' => 3,
        ],
        'rideau_court' => [
            'name' => 'Rideau court',
            'categoryArticle' => 'rideaux_voilages',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection'],
            'price' => 4,
        ],
        'rideau_long' => [
            'name' => 'Rideau long',
            'categoryArticle' => 'rideaux_voilages',
            'service' => ['Repassage', 'Lavage de linge de maison', 'Traitement anti-tâche et désinfection'],
            'price' => 5,
        ],
        'voilage' => [
            'name' => 'Voilage',
            'categoryArticle' => 'rideaux_voilages',
            'service' => ['Lavage de linge de maison', 'Traitement anti-tâche et désinfection'],
            'price' => 4,
        ],
        'house_de_canape' => [
            'name' => 'Housse de canapé',
            'categoryArticle' => 'mobilier',
            'service' => ['Lavage de linge de maison', 'Traitement anti-tâche et désinfection'],
            'price' => 8,
        ],
        'housse_de_fautueil' => [
            'name' => 'Housse de fautueil',
            'categoryArticle' => 'mobilier',
            'service' => ['Lavage de linge de maison', 'Traitement anti-tâche et désinfection'],
            'price' => 8,
        ],
        'coussin_de_chaise' => [
            'name' => 'Coussin de chaise',
            'categoryArticle' => 'mobilier',
            'service' => ['Lavage de linge de maison', 'Traitement anti-tâche et désinfection'],
            'price' => 4,
        ],
        'ourlet_de_pantalon' => [
            'name' => 'Ourlet de pantalon',
            'categoryArticle' => 'ajustements',
            'service' => ['Aujustement de taille pour vêtements', 'Customisation et modification pour vêtements'],
            'price' => 9,
        ],
        'ajustement_robe' => [
            'name' => 'Ajustement de robe',
            'categoryArticle' => 'ajustements',
            'service' => ['Aujustement de taille pour vêtements', 'Customisation et modification pour vêtements'],
            'price' => 12,
        ],
        'remplacement_de_fermeture_eclair' => [
            'name' => 'Remplacement de fermeture éclair',
            'categoryArticle' => 'ajustements',
            'service' => ['Réparation de déchirures et remplacement de fermetures éclairs'],
            'price' => 6,
        ],
        'reparation_de_dechirure' => [
            'name' => 'Réparation de déchirure',
            'categoryArticle' => 'ajustements',
            'service' => ['Réparation de déchirures et remplacement de fermetures éclairs', 'Customisation et modification pour vêtements'],
            'price' => 8,
        ],
        'broderie' => [
            'name' => 'Broderie',
            'categoryArticle' => 'personnalisations',
            'service' => ['Customisation et modification pour vêtements'],
            'price' => 12,
        ],
        'ajout_de_patch' => [
            'name' => 'Ajout de patch',
            'categoryArticle' => 'personnalisations',
            'service' => ['Customisation et modification pour vêtements'],
            'price' => 12,
        ],
    ];


    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

// Création des Catégories de Services
$categoryServices = []; 
foreach (self::CATEGORIES_SERVICES as $key => $value) {
    $categoryService = new CategoryService();
    $categoryService
        ->setName($value['name'])
        ->setDescription($value['description'])
        ->setInformation($value['information']);
    $manager->persist($categoryService);
    $categoryServices[$key] = $categoryService;
}

// Assurez-vous de flush avant de créer les services pour obtenir les IDs générés pour les catégories
$manager->flush();

// Création des Services
foreach (self::SERVICES as $key => $value) {
    $service = new Service();
    $service
        ->setName($value['name'])
        ->setDescription($value['description'])
        ->setPrice($value['price']);

    // Vérifier et lier la catégorie de service
    $categoryId = $categoryServices[$value['category']]->getId();
    $category = $manager->getRepository(CategoryService::class)->find($categoryId);

    if ($category) {
        $service->addCategoryService($category);
    }

    $manager->persist($service);
    $services[$key] = $service;
}

// Assurez-vous de flush après la création des services
$manager->flush();

//Création des catégories d'articles 
$categoryArticles = [];
foreach (self::CATEGORIES_ARTICLES as $key => $categoryName) {
    $categoryArticle = new CategoryArticle();
    $categoryArticle->setName($categoryName);
    $manager->persist($categoryArticle);

    $categoryArticles[$key] = $categoryArticle;
}

//Création des articles
foreach (self::ARTICLES as $key => $value) {
    $article = new Article();
    $article
        ->setName($value['name'])
        ->setPrice($value['price'])
        ->setCategoryArticle($categoryArticles[$value['categoryArticle']]);

    if (isset($categoryArticles[$value['categoryArticle']])) {
        $article->setCategoryArticle($categoryArticles[$value['categoryArticle']]);
    }

    $manager->persist($article);
}
 

//Création d'utilisateurs
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPassword($this->hasher->hashPassword($user, 'test'))
                ->setRoles(['ROLE_USER'])
                ->setGender($faker->randomElement(['male', 'female']))
                ->setAdress($faker->address);

            $manager->persist($user);
        }
//Création Admin
            $admin = new User();
            $admin
                ->setEmail('admin@admin.com')
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPassword($this->hasher->hashPassword($user, 'admin'))
                ->setRoles(['ROLE_ADMIN'])
                ->setGender($faker->randomElement(['male', 'female']))
                ->setAdress($faker->address);

            $manager->persist($admin);
    
$manager->flush();

}
}
