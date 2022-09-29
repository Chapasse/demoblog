<?php

namespace App\DataFixtures;

use App\Entity\Voiture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 15; $i++)
        {
            $voiture =new Voiture;
            $voiture    ->setMarque("<p>marque de la voiture n°$i</p>")
                            ->setModele("<p>modele de la voiture n°$i</p>")
                            ->setPrix($i *370)
                            ->setDescription("la voiture n°$i est de marque et modele citée plus haut"); 
            $manager->persist($voiture);
        }

        $manager->flush();
    }
}
