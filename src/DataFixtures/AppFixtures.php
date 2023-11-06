<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use App\Entity\CategoryService;
use App\Entity\Service;
use App\Entity\ServiceHasCategoryService;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPassword(password_hash('user', PASSWORD_BCRYPT))
                ->setRoles(['ROLE_USER'])
                ->setGender($faker->randomElement(['male', 'female']))
                ->setAdress($faker->address);

            $manager->persist($user);
        }

            $admin = new User();
            $admin
                ->setEmail('admin@admin.com')
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPassword(password_hash('admin', PASSWORD_BCRYPT))
                ->setRoles(['ROLE_ADMIN'])
                ->setGender($faker->randomElement(['male', 'female']))
                ->setAdress($faker->address);

            $manager->persist($admin);

//CATEGORY SERVICE

$categories = [
    ['Pressing', 'Pour des vêtements et tissus délicats'],
    ['Blanchisserie', 'Services de lavage, séchage et pliage pour votre linge quotidien'],
    ['Ameublement', 'Pour les articles plus volumineux qui nécessitent des soins supplémentaires.'],
    ['Retouches', 'Ajustements et modifications sur mesure'],
];

$categoryServiceEntities = [];

foreach ($categories as $categoryData) {
    $categoryService = new CategoryService();
    $categoryService->setName($categoryData[0]);
    $categoryService->setDescription($categoryData[1]);
    $manager->persist($categoryService); 
    $categoryServiceEntities[] = $categoryService;
}



$services = [
    ['Nettoyage à sec', "Nettoyage doux sans produits chimiques agressifs, préservant la qualité de vos tissus et de l'environnement.", 10.00, 1],
    ['Nettoyage de tissus délicats', "Nettoyage doux sans produits chimiques agressifs, préservant la qualité de vos tissus et de l'environnement.", 15.00, 1],
    ['Repassage', 'description à venir', 5.00, 4],
    ['Lavage de linge de maison', 'Fraîcheur et propreté écologique pour tous vos textiles de maison.', 5.00, 4],  
    ['Traitement anti-tâche et désinfection', 'Élimination des taches tenaces et désinfection pour une propreté impeccable.', 5.00, 4],
    ['Lavage et pliage de linge au kilo', "Utilisation d'eau recyclée et de détergents écologiques pour nettoyer votre linge de manière durable.", 5.00, 4],
    ['Nettoyage rideaux et voilages', 'Soin délicat pour éliminer la poussière et les odeurs, tout en préservant la qualité des tissus.', 5.00, 4],
    ['Nettoyage de tapis et moquettes', "Un service de nettoyage en profondeur qui utilise des composés entièrement naturels.", 5.00, 4],
    ['Aujustement de taille pour vêtements', 'Modification précise de vos vêtements pour un ajustement parfait à votre silhouette.', 5.00, 4],
    ['Réparation de déchirures et remplacement de fermetures éclairs', 'Chaque intervention vise à prolonger la durée de vie de vos pièces avec des matériaux recyclés ou réutilisés.', 5.00, 4],
    ['Customisation et modification pour vêtements', 'Personnalisation créative pour renouveler et adapter vos pièces à votre style unique.', 5.00, 4],
];


foreach ($services as $serviceData) {
    $service = new Service();
    $service->setName($serviceData[0]);
    $service->setDescription($serviceData[1]);

   
    $service->setPrice($serviceData[2]); 

    $priceId = $serviceData[3];
    $service->setPriceId($priceId); 

    $manager->persist($service);




$manager->flush();

}
    }
}