<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use APP\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for($i = 1; $i <= 10; $i++)
        {
            $article=new Article;
            //on instancie la classe Article qui se trouve dans le dossier App/Entity
            //nous pouvons maintenant faire appel aux setters pour insérer des données
            $article    ->setTitle("Titre de l'article n°$i")
                            ->setContent("<p>Contenu de l'article n°$i</p>")
                            ->setImage("http://picsum.photos/250/150")
                            ->setCreatedAt(new \DateTime); //instanciation de la classe DateTime pour réccupérer la date d'aujourdui
            $manager->persist($article);
            //persist() permet de faire persister l'article dans le temps et préparer son insertion en BDD
        }
        $manager->flush();
        // flush() permet d'exécuter la requête SQL préparée grâce à persist()
    }
}

