<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends BaseFixture
{
    public function loadData(): void
    {
        // Générer 10 itinéraires 
        $this->createMany(10, 'produit', function() {
            return (new Produit())
                ->setNom('Route')
                ->setCategorie('velo')
                ->setPrix(30)
                ->setDescription($this->faker->realText())
                ->setImageName('casque-5fe77192c2be2372407641.jpg')
                ->setImageSize(100)
            ;
        });
    }
}