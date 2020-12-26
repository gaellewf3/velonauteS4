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
                ->setNom($this->faker->name)
                ->setCategorie('velo')
                ->setPrix(40)
                ->setDescription($this->faker->realText())
                ->setUpdateAt($this->faker->dateTime)
            ;
        });
    }
}