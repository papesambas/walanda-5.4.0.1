<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Categories;
use Faker;
use App\Entity\Users;
use App\Entity\Cycles;
use App\Entity\Niveaux;
use App\Entity\Enseignements;
use App\Entity\Etablissements;
use App\Entity\Publications;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 2; $i++) {
            if ($i === 1) {
                $etablissement = new Etablissements();
                $etablissement->setAdresse("Baco Djicoroni Plateau rue N.C");
                $etablissement->setCpteBancaire($faker->creditCardNumber('Visa', true, '-'));
                $etablissement->setDateOuverture(new \DateTimeImmutable());
                $etablissement->setDesignation("Mamadou TRAORE");
                $etablissement->setEmail("EMPT@gmail.com");
                $etablissement->setForme("Unipersonnel");
                $etablissement->setNumDecisionCreation($faker->bothify('??-####-??-###'));
                $etablissement->setNumDecisionOuverture($faker->bothify('??-####-??-###'));
                $etablissement->setNumFiscal($faker->bothify('####-??-###'));
                $etablissement->setNumSocial($faker->bothify('####-?-#####-??'));
                $etablissement->setTelephone("76 16 69 91");
                $etablissement->setTelephoneMobile("66 74 24 34");
            } else {
                $etablissement = new Etablissements();
                $etablissement->setAdresse("Baco Djicoroni Plateau rue N.C");
                $etablissement->setCpteBancaire($faker->creditCardNumber('Visa', true, '-'));
                $etablissement->setDateOuverture(new \DateTimeImmutable());
                $etablissement->setDesignation("Ecole Fondamentale");
                $etablissement->setEmail("EMPT@gmail.com");
                $etablissement->setForme("Unipersonnel");
                $etablissement->setNumDecisionCreation($faker->bothify('??-####-??-###'));
                $etablissement->setNumDecisionOuverture($faker->bothify('??-####-??-###'));
                $etablissement->setNumFiscal($faker->bothify('####-??-###'));
                $etablissement->setNumSocial($faker->bothify('####-?-#####-??'));
                $etablissement->setTelephone("76 16 69 91");
                $etablissement->setTelephoneMobile("66 74 24 34");
            }


            $manager->persist($etablissement);
            $this->addReference('etablissement_' . $i, $etablissement);
        }

        for ($i = 1; $i <= 12; $i++) {
            if ($i === 1) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
                $user = new Users();
                $password = 'azerty';
                $password = $this->encoder->hashPassword($user, 'password');
                $user->setEmail($faker->email);
                $user->setEtablissement($etablissement);
                $user->setIsVerified($faker->numberBetween(1, 1));
                $user->setNom("SIDIBE");
                $user->setPassword($password);
                $user->setPrenom('Pape Samba');
                $user->setTelephone("76 16 69 91");
                $user->setUsername('superadmin');
                $user->setRoles(["ROLE_SUPERADMIN"]);
            } elseif ($i === 2) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(2, 2));
                $user = new Users();
                $password = 'azerty';
                $password = $this->encoder->hashPassword($user, 'password');
                $user->setEmail($faker->email);
                $user->setEtablissement($etablissement);
                $user->setIsVerified($faker->numberBetween(0, 1));
                $user->setNom("COULIBALY");
                $user->setPassword($password);
                $user->setPrenom("Jean dit M'Bampie");
                $user->setTelephone($faker->e164PhoneNumber);
                $user->setUsername('jean');
                $user->setRoles(["ROLE_SUPERADMIN"]);
            } elseif ($i === 3) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
                $user = new Users();
                $password = 'azerty';
                $password = $this->encoder->hashPassword($user, 'password');
                $user->setEmail($faker->email);
                $user->setEtablissement($etablissement);
                $user->setIsVerified($faker->numberBetween(0, 1));
                $user->setNom("SIDIBE");
                $user->setPassword($password);
                $user->setPrenom("Alassane");
                $user->setTelephone($faker->e164PhoneNumber);
                $user->setUsername('junior');
                $user->setRoles(["ROLE_ADMIN"]);
            } elseif ($i === 4) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
                $user = new Users();
                $password = 'azerty';
                $password = $this->encoder->hashPassword($user, 'password');
                $user->setEmail($faker->email);
                $user->setEtablissement($etablissement);
                $user->setIsVerified($faker->numberBetween(0, 1));
                $user->setNom("SIDIBE");
                $user->setPassword($password);
                $user->setPrenom("Assa");
                $user->setTelephone($faker->e164PhoneNumber);
                $user->setUsername('aimee');
                $user->setRoles(["ROLE_ADMIN"]);
            } elseif ($i <= 8) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 2));
                $user = new Users();
                $password = 'azerty';
                $password = $this->encoder->hashPassword($user, 'password');
                $user->setEmail($faker->email);
                $user->setEtablissement($etablissement);
                $user->setIsVerified($faker->numberBetween(0, 1));
                $user->setNom($faker->firstName);
                $user->setPassword($password);
                $user->setPrenom($faker->lastName);
                $user->setTelephone($faker->e164PhoneNumber);
                $user->setUsername('educ' . $i);
                $user->setRoles(["ROLE_EDUCAT"]);
            } else {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
                $user = new Users();
                $password = 'azerty';
                $password = $this->encoder->hashPassword($user, 'password');
                $user->setEmail($faker->email);
                $user->setEtablissement($etablissement);
                $user->setIsVerified($faker->numberBetween(0, 1));
                $user->setNom($faker->firstName);
                $user->setPassword($password);
                $user->setPrenom($faker->lastName);
                $user->setTelephone($faker->e164PhoneNumber);
                $user->setUsername($faker->userName);
            }
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }
        for ($i = 1; $i <= 6; $i++) {
            if ($i === 1) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
                $enseignement = new Enseignements();
                $enseignement->setEtablissement($etablissement);
                $enseignement->setType("PréScolaire");
            } elseif ($i === 2) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
                $enseignement = new Enseignements();
                $enseignement->setEtablissement($etablissement);
                $enseignement->setType("Fondamental");
            } elseif ($i === 3) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(1, 1));
                $enseignement = new Enseignements();
                $enseignement->setEtablissement($etablissement);
                $enseignement->setType("Secondaire");
            } elseif ($i === 4) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(2, 2));
                $enseignement = new Enseignements();
                $enseignement->setEtablissement($etablissement);
                $enseignement->setType("PréScolaire");
            } elseif ($i === 5) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(2, 2));
                $enseignement = new Enseignements();
                $enseignement->setEtablissement($etablissement);
                $enseignement->setType("Fondamental");
            } elseif ($i === 6) {
                $etablissement = $this->getReference('etablissement_' . $faker->numberBetween(2, 2));
                $enseignement = new Enseignements();
                $enseignement->setEtablissement($etablissement);
                $enseignement->setType("Secondaire");
            }

            $manager->persist($enseignement);
            $this->addReference('enseignement_' . $i, $enseignement);
        }
        for ($i = 1; $i <= 8; $i++) {
            if ($i === 1) {
                $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(1, 1));
                $cycle = new Cycles();
                $cycle->setDesignation("Jardin d'enfants");
                $cycle->setEnseignement($enseignement);
            } elseif ($i === 2) {
                $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(2, 2));
                $cycle = new Cycles();
                $cycle->setDesignation("1er Cycle");
                $cycle->setEnseignement($enseignement);
            } elseif ($i === 3) {
                $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(2, 2));
                $cycle = new Cycles();
                $cycle->setDesignation("2nd Cycle");
                $cycle->setEnseignement($enseignement);
            } elseif ($i === 4) {
                $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(3, 3));
                $cycle = new Cycles();
                $cycle->setDesignation("Secondaire");
                $cycle->setEnseignement($enseignement);
            } elseif ($i === 5) {
                $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(4, 4));
                $cycle = new Cycles();
                $cycle->setDesignation("Jardin d'enfants");
                $cycle->setEnseignement($enseignement);
            } elseif ($i === 6) {
                $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(5, 5));
                $cycle = new Cycles();
                $cycle->setDesignation("1er Cycle");
                $cycle->setEnseignement($enseignement);
            } elseif ($i === 7) {
                $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(5, 5));
                $cycle = new Cycles();
                $cycle->setDesignation("2nd Cycle");
                $cycle->setEnseignement($enseignement);
            } else {
                $enseignement = $this->getReference('enseignement_' . $faker->numberBetween(6, 6));
                $cycle = new Cycles();
                $cycle->setDesignation("Secondaire");
                $cycle->setEnseignement($enseignement);
            }
            $manager->persist($cycle);
            $this->addReference('cycle_' . $i, $cycle);
        }
        for ($i = 1; $i <= 30; $i++) {
            if ($i === 1) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(1, 1));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("Petite Section");
            } elseif ($i === 2) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(1, 1));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("Moyenne Section");
            } elseif ($i === 3) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(1, 1));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("Grande Section");
            } elseif ($i === 4) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(2, 2));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("1ère Année");
            } elseif ($i === 5) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(2, 2));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("2ème Année");
            } elseif ($i === 6) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(2, 2));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("3ème Année");
            } elseif ($i === 7) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(2, 2));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("4ème Année");
            } elseif ($i === 8) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(2, 2));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("5ème Année");
            } elseif ($i === 9) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(2, 2));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("6ème Année");
            } elseif ($i === 10) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(3, 3));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("7ème Année");
            } elseif ($i === 11) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(3, 3));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("8ème Année");
            } elseif ($i === 12) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(3, 3));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("9ème Année");
            } elseif ($i === 13) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(4, 4));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("10ème Année");
            } elseif ($i === 14) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(4, 4));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("11ème Année");
            } elseif ($i === 15) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(4, 4));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("Terminale");
            } elseif ($i === 16) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(5, 5));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("Petite Section");
            } elseif ($i === 17) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(5, 5));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("Moyenne Section");
            } elseif ($i === 16) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(5, 5));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("Grande Section");
            } elseif ($i === 19) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(6, 6));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("1ère Année");
            } elseif ($i === 20) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(6, 6));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("2ème Année");
            } elseif ($i === 21) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(6, 6));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("3ème Année");
            } elseif ($i === 22) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(6, 6));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("4ème Année");
            } elseif ($i === 23) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(6, 6));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("5ème Année");
            } elseif ($i === 24) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(6, 6));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("6ème Année");
            } elseif ($i === 25) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(7, 7));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("7ème Année");
            } elseif ($i === 26) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(7, 7));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("8ème Année");
            } elseif ($i === 27) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(7, 7));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("9ème Année");
            } elseif ($i === 28) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(8, 8));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("10ème Année");
            } elseif ($i === 29) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(8, 8));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("11ème Année");
            } elseif ($i === 30) {
                $cycle = $this->getReference('cycle_' . $faker->numberBetween(8, 8));
                $niveau = new Niveaux();
                $niveau->setCycle($cycle);
                $niveau->setDesignation("Terminale");
            }
            $manager->persist($niveau);
            $this->addReference('niveau_' . $i, $niveau);
        }

        for ($i = 1; $i <= 5; $i++) {
            if ($i === 1) {
                $categorie = new Categories();
                $categorie->setNom("Français");
                $categorie->setDescription($faker->word());
            } elseif ($i === 2) {
                $categorie = new Categories();
                $categorie->setNom("Histoire");
                $categorie->setDescription($faker->word());
            } elseif ($i === 3) {
                $categorie = new Categories();
                $categorie->setNom("Géographie");
                $categorie->setDescription($faker->word());
            } elseif ($i === 4) {
                $categorie = new Categories();
                $categorie->setNom("Mathe");
                $categorie->setDescription($faker->word());
            } else {
                $categorie = new Categories();
                $categorie->setNom("Connaissances Générales");
                $categorie->setDescription($faker->word());
            }
            $manager->persist($categorie);
            $this->addReference('categorie_' . $i, $categorie);
        }

        for ($i = 1; $i <= 30; $i++) {
            $user = $this->getReference('user_' . $faker->numberBetween(3, 5));
            $categorie = $this->getReference('categorie_' . $faker->numberBetween(1, 5));
            $publication = new Publications();
            $publication->setIsActive($faker->randomElement([true, false]));
            $publication->setIsPublished($faker->randomElement([true, false]));
            $publication->setCategorie($categorie);
            $publication->setContenu($faker->realText(750));
            $publication->setTitre($faker->realText(15));
            $publication->setAuthor($user);
            $manager->persist($publication);
            $this->addReference('publications_' . $i, $publication);
        }



        $manager->flush();
    }
}