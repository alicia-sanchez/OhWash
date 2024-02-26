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
use App\Entity\Orders;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
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
        'nettoyage_a_sec' => [
            'name' => 'Nettoyage à sec',
            'description' => 'Nettoyage doux sans produits chimiques agressifs, préservant la qualité de vos tissus et de l\'environnement.',
            'price' => 6,
            'category' => ['pressing'],
            'category_article' => ['vetement_exterieur', 'tenue_quotidien', 'vetement_delicat', 'tenue_soiree', 'rideaux_voilages']
        ],
        'nettoyage_de_tissus_délicats' => [
            'name' => 'Nettoyage de tissus délicats',
            'description' => 'Nettoyage doux sans produits chimiques agressifs, préservant la qualité de vos tissus et de l\'environnement.',
            'price' => 8,
            'category' => ['pressing'],
            'category_article' => ['vetement_delicat', 'tenue_soiree', 'rideaux_voilages','linge_maison']
        ],
        'repassage' => [
            'name' => 'Repassage',
            'description' => 'description à venir.',
            'price' => 7,
            'category' => ['pressing'],
            'category_article' => ['tenue_quotidien', 'vetement_delicat', 'tenue_soiree', 'rideaux_voilages','linge_maison','bains' ]
        ],
        'lavage_de_linge_de_maison' => [
            'name' => 'Lavage de linge de maison',
            'description' => 'Fraîcheur et propreté écologique pour tous vos textiles de maison.',
            'price' => 10,
            'category' => ['blanchisserie'],
            'category_article' => ['linge_maison','bains', 'linge_cuisine', 'rideaux_voilages', 'mobilier']
        ],
        'traitement_anti-tâche_et_désinfection' => [
            'name' => 'Traitement anti-tâche et désinfection',
            'description' => 'Élimination des taches tenaces et désinfection pour une propreté impeccable.',
            'price' => 8,
            'category' => ['blanchisserie'],
            'category_article' => ['linge_maison','bains', 'linge_cuisine', 'rideaux_voilages', 'mobilier']
        ],
        'lavage_et_pliage_de_linge_au_kilo' => [
            'name' => 'Lavage et pliage de linge au kilo',
            'description' => 'Utilisation d\'eau recyclée et de détergents écologiques pour nettoyer votre linge de manière durable.',
            'price' => 12,
            'category' => ['blanchisserie'],
            'category_article' => ['vetement_exterieur', 'tenue_quotidien', 'vetement_delicat', 'tenue_soiree','linge_maison','bains' ]
        ],
        'nettoyage_rideaux_et_voilages' => [
            'name' => 'Nettoyage rideaux et voilages',
            'description' => 'Soin délicat pour éliminer la poussière et les odeurs, tout en préservant la qualité des tissus.',
            'price' => 10,
            'category' => ['ameublement'],
            'category_article' => ['rideaux_voilages']
        ],
        'nettoyage_de_tapis_et_moquettes' => [
            'name' => 'Nettoyage de tapis et moquettes',
            'description' => 'Un service de nettoyage en profondeur qui utilise des composés entièrement naturels.',
            'price' => 20,
            'category' => ['ameublement'],
            'category_article' => ['mobilier']
        ],
        'aujustement_de_taille_pour_vêtements' => [
            'name' => 'Aujustement de taille pour vêtements',
            'description' => 'Modification précise de vos vêtements pour un ajustement parfait à votre silhouette.',
            'price' => 8,
            'category' => ['retouche'],
            'category_article' => ['vetement_exterieur', 'tenue_quotidien', 'vetement_delicat', 'tenue_soiree', 'ajustements']
        ],
        'réparation_de_déchirures_et_remplacement_de_fermetures_éclairs' => [
            'name' => 'Réparation de déchirures et remplacement de fermetures éclairs',
            'description' => 'Chaque intervention vise à prolonger la durée de vie de vos pièces avec des matériaux recyclés ou réutilisés.',
            'price' => 8,
            'category' => ['retouche'],
            'category_article' => ['vetement_exterieur', 'tenue_quotidien', 'vetement_delicat', 'tenue_soiree', 'linge_maison', 'rideaux_voilages', 'ajustements', 'reparations' ]
        ],
        'customisation_et_modification_pour_vêtements' => [
            'name' => 'Customisation et modification pour vêtements',
            'description' => 'Personnalisation créative pour renouveler et adapter vos pièces à votre style unique.',
            'price' => 12,
            'category' => ['retouche'],
            'category_article' => ['vetement_exterieur', 'tenue_quotidien', 'vetement_delicat', 'tenue_soiree', 'rideaux_voilages', 'ajustements', 'reparations','personnalisations' ],
        ],
    ];

    private const CATEGORIES_ARTICLES = [
        'vetement_exterieur' => 'Vêtement extérieur',
        'tenue_quotidien' => 'Tenue quotidienne',
        'vetement_delicat' => 'Vêtement délicat',
        'tenue_soiree' => 'Tenue soirée',
        'rideaux_voilages' => 'Rideaux et voilages',
        'linge_maison' => 'Linge de maison',
        'bains' => 'Bains',
        'mobilier' => 'Mobilier',
        'ajustements' => 'Ajustements',
        'reparations' => 'Réparations',
        'personnalisations' => 'Personnalisations',
        'linge_cuisine' => 'Linge de cuisine',
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
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection', 'Lavage_et_pliage_de_linge_au_kilo'],
            'price' => 4,
        ],
        'tapis_de_bain' => [
            'name' => 'Tapis de bain',
            'categoryArticle' => 'bains',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection', 'Lavage_et_pliage_de_linge_au_kilo'],
            'price' => 4,
        ],
        'serviette_de_bain' => [
            'name' => 'Serviette de bain',
            'categoryArticle' => 'bains',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection', 'Lavage_et_pliage_de_linge_au_kilo'],
            'price' => 4,
        ],
        'serviette_de_toilette' => [
            'name' => 'Serviette de toilette',
            'categoryArticle' => 'bains',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection', 'Lavage_et_pliage_de_linge_au_kilo'],
            'price' => 4,
        ],
        'peignoir_de_bain' => [
            'name' => 'Peignoir de bain',
            'categoryArticle' => 'bains',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection', 'Lavage_et_pliage_de_linge_au_kilo'],
            'price' => 5,
        ],
        'nappe_2m' => [
            'name' => 'Nappe (2m)',
            'categoryArticle' => 'linge_cuisine',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection'],
            'price' => 5,
        ],
        'nappe_4m' => [
            'name' => 'Nappe (4m)',
            'categoryArticle' => 'linge_cuisine',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection'],
            'price' => 6,
        ],
        'serviette_de_table' => [
            'name' => 'Serviette de table',
            'categoryArticle' => 'linge_cuisine',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection', 'Lavage_et_pliage_de_linge_au_kilo'],
            'price' => 3,
        ],
        'rideau_court' => [
            'name' => 'Rideau court',
            'categoryArticle' => 'rideaux_voilages',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection'],
            'price' => 4,
        ],
        'rideau_long' => [
            'name' => 'Rideau long',
            'categoryArticle' => 'rideaux_voilages',
            'service' => ['Repassage', 'Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection'],
            'price' => 5,
        ],
        'voilage' => [
            'name' => 'Voilage',
            'categoryArticle' => 'rideaux_voilages',
            'service' => ['Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection'],
            'price' => 4,
        ],
        'house_de_canape' => [
            'name' => 'Housse de canapé',
            'categoryArticle' => 'mobilier',
            'service' => ['Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection'],
            'price' => 8,
        ],
        'housse_de_fautueil' => [
            'name' => 'Housse de fautueil',
            'categoryArticle' => 'mobilier',
            'service' => ['Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection'],
            'price' => 8,
        ],
        'coussin_de_chaise' => [
            'name' => 'Coussin de chaise',
            'categoryArticle' => 'mobilier',
            'service' => ['Lavage_de_linge_de_maison', 'Traitement_anti-tâche_et_désinfection'],
            'price' => 4,
        ],
        'ourlet_de_pantalon' => [
            'name' => 'Ourlet de pantalon',
            'categoryArticle' => 'ajustements',
            'service' => ['Aujustement_de_taille_pour_vêtements', 'Customisation_et_modification_pour_vêtements'],
            'price' => 9,
        ],
        'ajustement_robe' => [
            'name' => 'Ajustement de robe',
            'categoryArticle' => 'ajustements',
            'service' => ['Aujustement_de_taille_pour_vêtements', 'Customisation_et_modification_pour_vêtements'],
            'price' => 12,
        ],
        'remplacement_de_fermeture_eclair' => [
            'name' => 'Remplacement de fermeture éclair',
            'categoryArticle' => 'ajustements',
            'service' => ['Réparation_de_déchirures_et_remplacement_de_fermetures_éclairs'],
            'price' => 6,
        ],
        'reparation_de_dechirure' => [
            'name' => 'Réparation de déchirure',
            'categoryArticle' => 'ajustements',
            'service' => ['Réparation_de_déchirures_et_remplacement_de_fermetures_éclairs', 'Customisation_et_modification_pour_vêtements'],
            'price' => 8,
        ],
        'broderie' => [
            'name' => 'Broderie',
            'categoryArticle' => 'personnalisations',
            'service' => ['Customisation_et_modification_pour_vêtements'],
            'price' => 12,
        ],
        'ajout_de_patch' => [
            'name' => 'Ajout de patch',
            'categoryArticle' => 'personnalisations',
            'service' => ['Customisation_et_modification_pour_vêtements'],
            'price' => 12,
        ],
    ];

    
    public function load(ObjectManager $manager): void
    {
    
        
        $faker = Factory::create('fr_FR');
        


// Création des catégories d'articles 
$categoryArticles = [];
foreach (self::CATEGORIES_ARTICLES as $key => $categoryName) {
    $categoryArticle = new CategoryArticle();
    $categoryArticle->setName($categoryName);
    $manager->persist($categoryArticle);

    $categoryArticles[$key] = $categoryArticle; // Stockage dans le tableau
}

$manager->flush(); // Flush pour obtenir les références


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

// Création des services
// Création des services
foreach (self::SERVICES as $key => $serviceData) {
    $service = new Service();
    $service->setName($serviceData['name']);
    $service->setDescription($serviceData['description']);
    $service->setPrice($serviceData['price']);

    // Associer les catégories de services avec le service
    foreach ($serviceData['category'] as $categoryServiceKey) {
        // Récupérer l'objet CategoryService correspondant à la clé
        $categoryService = $categoryServices[$categoryServiceKey];

        // Ajouter le CategoryService au service en utilisant la méthode addCategoryService
        $service->addCategoryService($categoryService);
    }

    // Associer les catégories d'articles avec le service
// Associer les catégories d'articles avec le service
foreach ($serviceData['category_article'] as $categoryArticleKey) {
    // Vérifiez que la clé existe dans vos données fixtures avant d'accéder à $categoryArticles
    if (array_key_exists($categoryArticleKey, $categoryArticles)) {
        // Récupérer l'objet CategoryArticle correspondant à la clé
        $categoryArticle = $categoryArticles[$categoryArticleKey];

        // Ajouter le CategoryArticle au service en utilisant la méthode addCategoryArticle
        $service->addCategoryArticle($categoryArticle);
    } else {
        // Gérer l'erreur si la clé n'existe pas dans $categoryArticles
        echo "Clé non trouvée dans les catégories d'articles : $categoryArticleKey";
    }
}


    $manager->persist($service);
}



$manager->flush();







// Création des articles
// Création des articles
foreach (self::ARTICLES as $key => $value) {
    $article = new Article();
    $article
        ->setName($value['name'])
        ->setPrice($value['price']);

    $categoryArticleKey = $value['categoryArticle'];

    if (isset($categoryArticles[$categoryArticleKey])) {
        $article->addCategoryArticle($categoryArticles[$categoryArticleKey]);
    }

    $manager->persist($article);
}


//Création d'utilisateurs
        for ($i = 0; $i < 8; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPassword($this->hasher->hashPassword($user, 'test'))
                ->setRole([$faker->randomElement(['ROLE_USER', 'ROLE_EMPLOYE'])])
                ->setGender($faker->randomElement(['male', 'female']))
                ->setAdress($faker->address)
                ->setCity($faker->city)
                ->setZipCode((int) $faker->postcode)
                ->setCountry($faker->country);

            $manager->persist($user);
        }

//Création Admin
$admin = new User();
$admin
    ->setEmail('admin@admin.com')
    ->setFirstname($faker->firstName)
    ->setLastname($faker->lastName)
    ->setPassword($this->hasher->hashPassword($admin, 'admin')) // Utilise $admin ici au lieu de $user
    ->setRole(['ROLE_ADMIN'])
    ->setGender($faker->randomElement(['male', 'female']))
    ->setAdress($faker->address)
    ->setCity($faker->city)
    ->setZipCode((int) $faker->postcode)
                ->setCountry($faker->country);

$manager->persist($admin);


// Création de commandes pour chaque utilisateur
for ($j = 0; $j < 6; $j++) {
    $order = new Orders();
    $order->setStatus($faker->randomElement(['à traiter', 'en cours', 'terminée']));
    $order->setStatusDate($faker->dateTimeThisYear());
    $order->setPayementDate($faker->dateTimeThisYear());
    $order->setTotalPrice($faker->randomFloat(2, 20, 200));
    $order->setDepositDate($faker->dateTimeThisYear());
    $order->setPickupDate($faker->dateTimeThisYear());
    $order->setUser($user);
    
    // Ajoutez quelques articles à chaque commande
    $articleKeys = array_keys(self::ARTICLES);
    $selectedArticles = $faker->randomElements($articleKeys, mt_rand(1, 4));

    foreach ($selectedArticles as $articleKey) {
        $articleData = self::ARTICLES[$articleKey];
        $article = new Article();
        $article->setName($articleData['name']);
        $article->setPrice($articleData['price']);
        // Configurez ici d'autres propriétés de l'article, comme la catégorie et les services
        $manager->persist($article);

        // Associez l'article à la commande
        $order->addArticle($article);
    }

    $manager->persist($order);
}

$manager->flush();
}


}
    



