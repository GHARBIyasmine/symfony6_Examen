<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantSectionFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i =0 ; $i<20; $i++){
            $etd = new Etudiant();
            $sect = new Section();
            $etd->setNom($faker->lastName);
            $etd->setPrenom($faker->firstName);
            $sect->setDesignation('section '.$i);
            $etd->setSection($sect);
            $manager->persist($etd);
            $manager->persist($sect);

        }
        for ($i =0 ; $i<10; $i++){
            $etd = new Etudiant();
            $etd->setNom($faker->lastName);
            $etd->setPrenom($faker->firstName);
            $manager->persist($etd);

        }
        $manager->flush();
    }
}
