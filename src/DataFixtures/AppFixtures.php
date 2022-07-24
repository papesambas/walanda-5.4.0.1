<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Etablissements;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i < 2; $i++) {
            $etablissement = new Etablissements();
            $etablissement->setDesignation("Ecole Fondamentale de Baco Djicoroni");
            $etablissement->setForme("Unipersonnelle");
            $etablissement->setAdresse("Baco Djicoroni Plateau Rue N.C");
            $etablissement->setEmail("EMPT@gmail.com");
            $etablissement->setCpteBancaire($faker->creditCardNumber('Visa', true, '-'));
            $etablissement->setDateOuverture(new \DateTimeImmutable);
            $etablissement->setNumDecisionCreation($faker->bothify('??-####-??-#####'));
            $etablissement->setNumDecisionOuverture($faker->bothify('??-####-??-#####'));
            $etablissement->setNumFiscal($faker->bothify('??-####-?-###-?'));
            $etablissement->setNumSocial($faker->bothify('??-####-??-###'));
            $etablissement->setTelephone("76-16-69-91");
            $etablissement->setTelephoneMobile("66-74-24-34");

            $manager->persist($etablissement);
            $this->addReference('etablissement_' . $i, $etablissement);
            // $product = new Product();
            // $manager->persist($product);
        }

        $manager->flush();
    }
}