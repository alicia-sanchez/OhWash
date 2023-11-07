<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use App\Entity\CategoryService;
use App\Entity\Service;
use App\Entity\ServiceHasCategoryService;
use App\Entity\CategoryArticle; 
use App\Entity\Article; 
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
     

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



//PRESSING
$categoryServicePressing = new CategoryService();
        $categoryServicePressing->setName('Pressing');
        $categoryServicePressing->setDescription('Pour des vêtements et tissus délicats');
        $categoryServicePressing->setInformation('Laver + Repassage + sur cintre');
        $manager->persist($categoryServicePressing);

//BLANCHISSERIE
$categoryServiceBlanchisserie = new CategoryService();
        $categoryServiceBlanchisserie->setName('Blanchisserie');
        $categoryServiceBlanchisserie->setDescription('Services de lavage, séchage et pliage pour votre linge quotidien');
        $categoryServiceBlanchisserie->setInformation('Laver + Secher au sèche-linge + dans un sac');
        $manager->persist($categoryServiceBlanchisserie);

//AMEUBLEMENT
$categoryServiceAmeublement = new CategoryService();
        $categoryServiceAmeublement->setName('Ameublement');
        $categoryServiceAmeublement->setDescription('Pour les articles plus volumineux qui nécessitent des soins supplémentaires.');
        $categoryServiceAmeublement->setInformation('Nettoyage personnalisé');
        $manager->persist($categoryServiceAmeublement);
        
//RETOUCHE
        
        
$categoryServiceRetouche = new CategoryService();
        $categoryServiceRetouche->setName('Retouche');
        $categoryServiceRetouche->setDescription('Ajustements et modifications sur mesure.');
        $categoryServiceRetouche->setInformation('Voir directement avec nos professionnels');
        $manager->persist($categoryServiceRetouche);


$categoriesArticles = [
        'Vêtement d\'extérieur' => ['Veste', 'Imperméable', 'Doudoune', 'Blouson / Parka'],
        'Tenue de tous les jours' => ['Pull', 'T-shirt', 'Pantalon', 'Jean', 'Jupe', 'Short', 'Robe'],
        'Vêtement délicats' => ['Chemisier en soie', 'Pantalon en cuir', 'Pull cachemire', 'Robe en cuir', 'Chemisier en dentelle'],
        'Tenue de soirée' => ['Costume (2 pièces)', 'Costume (3 pièces)', 'Robe de soirée'],
        'Accessoires' => ['Foulard / Echarpe', 'Cravate / Noeud papillon', 'Chaussettes / Sous-vêtements'],
        'Linge de maison' => [
            'Drap - Simple', 'Drap - Double', 'Housse de couette - Simple', 'Housse de couette - Double',
            'Housse de coussin - Petit', 'Housse de coussin - Moyen', 'Housse de coussin - Grand', "Taie d'oreiller"
        ],
        'Bains' => ['Tapis de bain', 'Serviette de bain', 'Serviette de toilette', 'Peignoir de bain'],
        'Linge de cuisine' => ['Nappe (2m)', 'Nappe (4m)', 'Serviette de table', 'Torchon'],
        ];


        foreach ($categoriesArticles as $categoryName => $articles) {
            $categoryArticle = new CategoryArticle();
            $categoryArticle->setName($categoryName);
            $categoryArticle->setCategoryService($categoryServicePressing); // Associez la catégorie d'articles à la catégorie de service "Pressing"
            $manager->persist($categoryArticle);

            foreach ($articles as $articleName) {
                $article = new Article();
                $article->setName($articleName);
                $article->setCategoryArticle($categoryArticle); // Associez l'article à la catégorie d'articles
                $manager->persist($article);
            }
        }

$manager->flush();

}
}
