<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $marque1 = new Marque();
        $marque1->setLibelle('Toyota');
        $manager->persist($marque1);
        $marque2 = new Marque();
        $marque2->setLibelle('Peugeot');
        $manager->persist($marque2);

        $modele1 = new Modele();
        $modele1->setLibelle('Yaris')
            ->setImage('modele1.jpg')
            ->setPrixMoyen(15000)
            ->setMarque($marque1);
        $manager->persist($modele1);

        $modele2 = new Modele();
        $modele2->setLibelle('3008')
            ->setImage('modele2.jpg')
            ->setPrixMoyen(35000)
            ->setMarque($marque2);
        $manager->persist($modele2);

        $modele3 = new Modele();
        $modele3->setLibelle('Corolla')
            ->setImage('modele3.jpg')
            ->setPrixMoyen(25000)
            ->setMarque($marque1);
        $manager->persist($modele3);

        $modele4 = new Modele();
        $modele4->setLibelle('Camry')
            ->setImage('modele4.jpg')
            ->setPrixMoyen(45000)
            ->setMarque($marque1);
        $manager->persist($modele4);

        $modele5 = new Modele();
        $modele5->setLibelle('508')
            ->setImage('modele5.jpg')
            ->setPrixMoyen(37000)
            ->setMarque($marque2);
        $manager->persist($modele5);

        $modele6 = new Modele();
        $modele6->setLibelle('308')
            ->setImage('modele6.jpg')
            ->setPrixMoyen(25000)
            ->setMarque($marque2);
        $manager->persist($modele6);

        $faker = \Faker\Factory::create('fr_FR');
        $modeles = [$modele1, $modele2, $modele3, $modele4, $modele5, $modele6];

        foreach ($modeles as $m) {
            $rand = rand(3, 5);
            for ($i = 1; $i <= $rand; $i++) {
                $voiture = new Voiture();
                $voiture->setImmatriculation($faker->regexify('[A-Z]{2}[0-9]{3,4}[A-Z]{2}'))
                    ->setNbPortes($faker->randomElement($array = array(3, 5)))
                    ->setAnne($faker->numberBetween($min = 1990, $max = 2019))
                    ->setModele($m);
                $manager->persist($voiture);
            };
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
